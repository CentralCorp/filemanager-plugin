@extends('admin.layouts.admin')

@section('title', 'Configuration elFinder')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('filemanager.admin.updateConfig') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="dirs">Répertoires (séparés par des virgules, laissez vide si vous souhaitez avoir accès à tous les dossiers de "Storage")</label>
                    <textarea name="dirs" id="dirs" class="form-control" rows="5">{{ implode(', ', array_map(function($dir) { return str_replace('storage/', '', $dir); }, $dirs)) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
            </form>
        </div>
    </div>
@endsection
