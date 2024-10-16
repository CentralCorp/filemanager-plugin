<?php

namespace Azuriom\Plugin\FileManager\Controllers\Admin;

use Azuriom\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ConfigController extends Controller
{
    public function editConfig()
    {
        $dirs = Config::get('elfinder.dir', []);
        return view('filemanager::admin.config', compact('dirs'));
    }

    public function updateConfig(Request $request)
    {
        $request->validate([
            'dirs' => 'nullable|string', // Permettre une chaîne vide
        ]);

        $dirsInput = $request->input('dirs');

        // Si l'utilisateur ne saisit rien, donner accès à tous les dossiers
        if (empty($dirsInput)) {
            // Configuration pour donner accès à tous les dossiers
            $dirs = []; // Valeur vide pour signifier tous les dossiers
        } else {
            // Enlever les espaces et traiter les entrées
            $dirs = array_map('trim', explode(',', $dirsInput));
        }

        // Créer les répertoires si nécessaire
        foreach ($dirs as $dir) {
            $dirPath = trim($dir);
            if (!empty($dirPath) && !Storage::disk('public')->exists($dirPath)) {
                Storage::disk('public')->makeDirectory($dirPath);
            }
        }

        $configPath = base_path('plugins/filemanager/config/elfinder.php');
        $config = include($configPath);

        // Mettre à jour les répertoires avec le préfixe 'storage/'
        if (empty($dirs)) {
            // Permettre l'accès à tous les dossiers
            $config['dir'] = ['storage/']; // On peut aussi mettre 'storage/' comme un accès
        } else {
            $config['dir'] = array_map(function($dir) {
                return 'storage/' . trim($dir);
            }, $dirs);
        }

        // Sauvegarder la nouvelle configuration
        $newConfigContent = '<?php return ' . var_export($config, true) . ';';
        File::put($configPath, $newConfigContent);

        return redirect()->route('filemanager.admin.config')->with('success', 'Configuration mise à jour avec succès.');
    }

    public function createMissingDirectories()
    {
        $nonExistentDirs = session()->get('non_existent_dirs', []);

        foreach ($nonExistentDirs as $dir) {
            Storage::disk('public')->makeDirectory($dir);
            Log::info('Création du répertoire', ['directory' => $dir]);
        }

        session()->forget('non_existent_dirs');
        Log::info('Répertoires manquants créés et session effacée.');

        return redirect()->route('filemanager.admin.config')->with('success', 'Dossiers créés avec succès.');
    }
}
