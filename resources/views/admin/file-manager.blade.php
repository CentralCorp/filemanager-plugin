@extends('admin.layouts.admin')

@section('title', 'Gestionnaire de fichiers')

@section('page-title', 'Gestionnaire de fichiers')
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

<link rel="stylesheet" type="text/css" href="{{plugin_asset('filemanager', 'packages/barryvdh/elfinder/css/elfinder.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{plugin_asset('filemanager', 'packages/barryvdh/elfinder/css/theme.css')}}">
<script src="{{plugin_asset('filemanager', 'packages/barryvdh/elfinder/js/elfinder.min.js')}}"></script>

<script type="text/javascript" charset="utf-8">
    $().ready(function() {
        $('#elfinder').elfinder({
            customData: {
                _token: '<?= csrf_token() ?>'
            },
            url : '<?= route("filemanager.admin.elfinder.connector") ?>',  // connector URL
        });
    });
</script>

@section('content')
    <div id="elfinder" style="height: 1200px;"></div>
@endsection
