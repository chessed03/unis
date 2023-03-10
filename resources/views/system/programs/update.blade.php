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

                                <h6>Editar programa</h6>

                                <a href="{{ route('program-index') }}">
                                    <button type="button" class="btn btn-info elevation-2">
                                        <i class="bx bx-fw bx-chevron-left-circle"></i> Regresar
                                    </button>
                                </a>

                            </div>

                        </div>

                        <div class="card-body">

                            <form action="{{ route('program-save-update') }}" method="POST">

                                @csrf

                                <input type="hidden" name="id" id="id" value="{{ $item->id }}">

                                <div class="row">

                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">

                                        <div class="row">

                                            <div  class="col-sm-12 col-md-12 col-lg-6 col-xl-6">

                                                <div class="row">
                                                    
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                        <label for="schools">Universidad:</label>
                                                        <select name="school_id" id="school_id" class="form-control select2bs4 @error('school_id') is-invalid @enderror">
                                                            <option selected></option>
                                                            @foreach( $list_schools as $school )
                                                                <option {{ ( $school->id == $item->school_id ?? '' )  ? 'selected' : '' }} value="{{ $school->id }}">{{ $school->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('school_id')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                    </div>

                                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                                        <label for="name">Nombre del programa:</label>
                                                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $item->name }}" oninput="generateSlug('name', 'slug')">
                                                        @error('name')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                    </div>

                                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                                        <label for="slug">Slug:</label>
                                                        <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ $item->slug }}">
                                                        @error('slug')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                    </div>
        
                                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                                        <label for="level">Nivel:</label>
                                                        <input type="text" name="level" id="level" class="form-control @error('level') is-invalid @enderror" value="{{ $item->level }}">
                                                        @error('level')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                    </div>

                                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-group">
                                                        <label for="area">Área:</label>
                                                        <input type="text" name="area" id="area" class="form-control @error('area') is-invalid @enderror" value="{{ $item->area }}">
                                                        @error('area')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                    </div>
        
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                        <label for="description">Descripción:</label>
                                                        <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ $item->description }}">
                                                        @error('description')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                    </div>

                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                        <label for="duration">Duración:</label>
                                                        <input type="text" name="duration" id="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ $item->duration }}">
                                                        @error('duration')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                    </div>
        
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                        <label>Imagen:</label>
                                                        <div class="input-group">
                                                            <label class="input-group-btn">
                                                        <span class="btn btn-primary btn-file elevation-2" onchange="uploadImage()" data-action="btn-upload" data-input-url="image_url" data-preview-image="image_preview">
                                                            <i class='bx bx-fw bx-cloud-upload btn-upload'></i> Cargar imagen <input accept=".jpg,.png,.jpeg,.gif" class="hidden" name="upload_image" type="file" id="upload_image">
                                                        </span>
                                                            </label>
                                                            &nbsp;&nbsp;
                                                            <input class="form-control @error('image_url') is-invalid @enderror" name="image_url" readonly="readonly" id="image_url" type="text" value="{{ $item->image_url }}">
                                                            @error('image_url')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">

                                                <div class="row">
                
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                        <label for="image_preview">Previsualización de la imagen:</label>
                                                        <img
                                                            src="{{ $item->image_url ?? asset('template/admin/img/sitio/site-working-none.png') }}"
                                                            id="image_preview"
                                                            class="w-100 shadow-1-strong rounded mb-4"
                                                            height="410px"
                                                        />
                                                    </div>
        
                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <label for="content">Contenido:</label>
                                        <textarea name="content" id="content" class="form-control form-group tiny-editor">{{ $item->content }}</textarea>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        @error('content')<span class="error text-danger small"><strong>{{ $message }}</strong></span> @enderror
                                    </div>

                                    <div class="col-12 text-right mt-4">

                                        <a href="{{ route('program-index') }}">
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

        tinyEditor( url_upload_image, token );

    </script>

@endsection
