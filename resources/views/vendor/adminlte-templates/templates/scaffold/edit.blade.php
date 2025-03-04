@@extends('layouts.index')

@@section('content_header')
    <h1>Edit {{ $config->modelNames->name }}</h1>
@@stop

@@section('content')
    @@include('partials.breadcrumbs')

    <div class="row">
        <div class="col-lg-12">
            @@include('adminlte-templates::common.errors')
            <div class="card card-outline card-primary">
                <div class="card-header">
                <a href="{{ '{{' }} route('{!! $config->prefixes->getRoutePrefixWith('.') !!}{!! $config->modelNames->camelPlural !!}.index') }}" class="btn btn-primary btn-sm"><i
                        class="fas fa-arrow-circle-left"></i></i>&ensp;Kembali ke Daftar {{ $config->modelNames->name }}</a>
            </div>
            @{!! Form::model(${{ $config->modelNames->camel }}, ['route' => ['{{ $config->prefixes->getRoutePrefixWith('.') }}{{ $config->modelNames->camelPlural }}.update', ${{ $config->modelNames->camel }}->{{ $config->primaryName }}], 'method' => 'patch']) !!}

            <div class="card-body">
                <div>
                    @@include('{{ $config->prefixes->getViewPrefixForInclude() }}{{ $config->modelNames->snakePlural }}.fields')
                </div>
            </div>

            <div class="card-footer">
                @{!! Form::button('<i class="fas fa-times"></i> Batal', ['type' => 'reset', 'class' => 'btn btn-danger btn-sm'] )  !!}
                @{!! Form::button('<i class="fas fa-save"></i> Simpan', ['type' => 'submit', 'class' => 'btn btn-primary btn-sm'] )  !!}
            </div>

            @{!! Form::close() !!}

        </div>
    </div>
</div>
@@endsection
