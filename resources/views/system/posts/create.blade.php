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

                                <h6>Crear posts</h6>

                                <a href="{{ route('post-index') }}">
                                    <button type="button" class="btn btn-info elevation-2">
                                        <i class="bx bx-fw bx-chevron-left-circle"></i> Regresar
                                    </button>
                                </a>

                            </div>

                        </div>

                        <div class="card-body">

                            <form action="{{ route('post-save-create') }}" method="POST">

                                @csrf

                                <div class="row">

                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <label for="title">Titulo:</label>
                                        <input type="text" name="title" id="title" class="form-control form-group" value="{{ old('title') }}" oninput="generateSlug()">
                                        @error('title') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <label for="slug">Slug:</label>
                                        <input type="text" name="slug" id="slug" class="form-control form-group slug" value="{{ old('slug') }}">
                                        @error('slug') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <label for="subtitle">Subtitulo:</label>
                                        <input type="text" name="subtitle" id="subtitle" class="form-control form-group" value="{{ old('subtitle') }}">
                                        @error('subtitle') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <label for="schools">Universidades:</label>
                                        <div class="select2-success form-group">
                                            <select name="schools[]" id="schools" class="select2" data-dropdown-css-class="select2-success" multiple="multiple">
                                                @foreach( $list_schools as $item )
                                                    <option {{ ( in_array( $item->id, old('schools') ?? [] ) ) ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('schools') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <label for="content">Contenido:</label>
                                        <textarea name="content" id="content" class="form-control form-group tiny-editor">{{ old('content') }}</textarea>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        @error('content') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="col-12 text-right mt-4">

                                        <a href="{{ route('post-index') }}">
                                            <button type="button" class="btn btn-danger elevation-2 mr-4">
                                                <i class="bx-fw bx bx-x-circle"></i> Cancelar
                                            </button>
                                        </a>

                                        <button type="submit" class="btn btn-success elevation-2"><i class='bx-fw bx bx-save'></i> Guardar</button>

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

        let url_upload_image = '{{ route("post-upload-image") }}';

        let token            = '{{ csrf_token() }}';

        tinyEditor( url_upload_image, token );

    </script>

@endsection