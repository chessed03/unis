@extends('template.app')

@section('content')

    <div class="content-header">

        <div class="container-fluid">

            <div class="col-12 d-flex justify-content-between">

                <h1 class="">{{ $submodule }}</h1>

                <ol class="breadcrumb float-sm">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx-fw bx bx-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#">{{ $module }}</a></li>
                    <li class="breadcrumb-item"><a href="#">{{ $submodule }}</a></li>
                    <li class="breadcrumb-item active">{{ $location }}</li>
                </ol>

            </div>

        </div>

    </div>

    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">

                    <div class="card card-default">

                        <div class="card-header">

                            <div class="row justify-content-between">

                                <h6>Crear sitio</h6>

                                <a href="{{ route('site-index') }}">
                                    <button type="button" class="btn btn-info elevation-2">
                                        <i class="bx bx-fw bx-chevron-left-circle"></i> Regresar
                                    </button>
                                </a>

                            </div>

                        </div>

                        <div class="card-body">

                            <form action="{{ route('site-save-create') }}" method="POST">

                                @csrf

                                <div class="row">

                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">

                                        <div class="row">

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                <label for="schools">Universidad:</label>
                                                <select name="school_id" id="school_id" class="form-control select2bs4 @error('school_id') is-invalid @enderror">
                                                    <option selected></option>
                                                    @foreach( $list_schools as $school )
                                                        <option {{ ( $school->id == old('school_id') ?? '' )  ? 'selected' : '' }} value="{{ $school->id }}">{{ $school->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('school_id')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                <label for="title">Título del sitio:</label>
                                                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                                                @error('title')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                <label for="base_url">URL:</label>
                                                <input type="text" name="base_url" id="base_url" class="form-control @error('base_url') is-invalid @enderror" value="{{ old('base_url') }}">
                                                @error('base_url')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                <label for="server_name">Nombre del servidor:</label>
                                                <input type="text" name="server_name" id="server_name" class="form-control @error('server_name') is-invalid @enderror" value="{{ old('server_name') }}">
                                                @error('server_name')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                                <label for="primary_color">Color primario:</label>
                                                <input type="text" name="primary_color" id="primary_color" class="form-control" value="{{ old('primary_color') }}">
                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                                <label for="secondary_color">Color secundario:</label>
                                                <input type="text" name="secondary_color" id="secondary_color" class="form-control" value="{{ old('secondary_color') }}">
                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">

                                        <div class="row">

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                <label>Favicon:</label>
                                                <div class="input-group">
                                                    <label class="input-group-btn">
                                                <span class="btn btn-primary btn-file elevation-2" onchange="uploadImage()" data-action="btn-upload" data-input-url="favicon_url" data-preview-image="favicon_preview">
                                                    <i class='bx bx-fw bx-cloud-upload btn-upload'></i> Cargar favicon <input accept=".ico" class="hidden" name="upload_image" type="file" id="upload_image">
                                                </span>
                                                    </label>
                                                    &nbsp;&nbsp;
                                                    <input class="form-control @error('favicon_url') is-invalid @enderror" name="favicon_url" readonly="readonly" id="favicon_url" type="text" value="{{ old('favicon_url') }}">
                                                    @error('favicon_url')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                <label for="favicon_preview">Previsualización del favicon:</label>
                                                <img
                                                    src="{{ asset('template/admin/img/sitio/site-working-none.png') }}"
                                                    id="favicon_preview"
                                                    class="w-100 shadow-1-strong rounded mb-4"
                                                    height="280px"
                                                />
                                            </div>

                                    </div>

                                    <div class="col-12 text-right mt-4">

                                        <a href="{{ route('site-index') }}">
                                            <button type="button" class="btn btn-danger elevation-2 mr-4">
                                                <i class="bx-fw bx bx-x-circle"></i> Cancelar
                                            </button>
                                        </a>

                                        <button type="submit" class="btn btn-success elevation-2"><i class='bx bx-fw bx-save'></i> Guardar</button>

                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection

@section('scripts')

    <script>

        let url_upload_image = '{{ route("multimedia-upload-image") }}';

        let token            = '{{ csrf_token() }}';

        uploadImage( url_upload_image, token );

    </script>

@endsection
