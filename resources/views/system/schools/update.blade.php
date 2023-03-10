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

                                <h6>Editar universidad</h6>

                                <a href="{{ route('school-index') }}">
                                    <button type="button" class="btn btn-info elevation-2">
                                        <i class="bx bx-fw bx-chevron-left-circle"></i> Regresar
                                    </button>
                                </a>

                            </div>

                        </div>

                        <div class="card-body">

                            <form action="{{ route('school-save-update') }}" method="POST">

                                @csrf

                                <input type="hidden" name="id" id="id" value="{{ $item->id }}">

                                <div class="row">

                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">

                                        <div class="row">

                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                                <label for="name">Nombre:</label>
                                                <input type="text" name="name" id="name" class="form-control form-group @error('name') is-invalid @enderror" value="{{ $item->name }}">
                                                @error('name')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                            </div>
        
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                                <label for="contact">Contacto:</label>
                                                <input type="text" name="contact" id="contact" class="form-control form-group @error('contact') is-invalid @enderror" value="{{ $item->contact }}">
                                                @error('contact')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                            </div>
        
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                <label for="address">Dirección:</label>
                                                <input type="text" name="address" id="address" class="form-control form-group @error('address') is-invalid @enderror" value="{{ $item->address }}">
                                                @error('address')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                            </div>
        
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                                <label for="phone_main">Telefono principal:</label>
                                                <input type="text" name="phone_main" id="phone_main" class="form-control form-group @error('phone_main') is-invalid @enderror" value="{{ $item->phone_main }}">
                                                @error('phone_main')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                            </div>
        
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                                <label for="phone_secondary">Telefono secundario:</label>
                                                <input type="text" name="phone_secondary" id="phone_secondary" class="form-control form-group" value="{{ $item->phone_secondary }}">
                                            </div>
        
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                                <label for="email_main">Correo principal:</label>
                                                <input type="text" name="email_main" id="email_main" class="form-control form-group @error('email_main') is-invalid @enderror" value="{{ $item->email_main }}">
                                                @error('email_main')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                            </div>
        
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                                <label for="email_secondary">Correo secundario:</label>
                                                <input type="text" name="email_secondary" id="email_secondary" class="form-control form-group @error('email_secondary') is-invalid @enderror" value="{{ $item->email_secondary }}">
                                            </div>
        
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                                <label for="facebook">Facebook:</label>
                                                <input type="text" name="facebook" id="facebook" class="form-control form-group" value="{{ $item->facebook }}">
                                            </div>
        
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                                <label for="instagram">Instagram:</label>
                                                <input type="text" name="instagram" id="instagram" class="form-control form-group" value="{{ $item->instagram }}">
                                            </div>
        
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                                <label for="twitter">Twitter:</label>
                                                <input type="text" name="twitter" id="twitter" class="form-control form-group" value="{{ $item->twitter }}">
                                            </div>
        
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                                <label for="youtube">Youtube:</label>
                                                <input type="text" name="youtube" id="youtube" class="form-control form-group" value="{{ $item->youtube }}">
                                            </div>
                
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                <label for="description">Descripción:</label>
                                                <input type="text" name="description" id="description" class="form-control form-group @error('description') is-invalid @enderror" value="{{ $item->description }}">
                                                @error('description')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">

                                        <div class="row">

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                <label>Logo:</label>
                                                <div class="input-group">
                                                    <label class="input-group-btn">
                                                <span class="btn btn-primary btn-file elevation-2" onchange="uploadImage()" data-action="btn-upload" data-input-url="logo_url" data-preview-image="logo_preview">
                                                    <i class='bx bx-fw bx-cloud-upload btn-upload'></i> Cargar logo <input accept=".jpg,.png,.jpeg,.gif" class="hidden" name="upload_image" type="file" id="upload_image">
                                                </span>
                                                    </label>
                                                    &nbsp;&nbsp;
                                                    <input class="form-control @error('logo_url') is-invalid @enderror" name="logo_url" readonly="readonly" id="logo_url" type="text" value="{{ $item->logo_url }}">
                                                    @error('logo_url')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">

                                                <label for="social_networks">Previsualización del logo:</label>

                                                <img
                                                    src="{{ $item->logo_url ?? asset('template/admin/img/sitio/site-working-none.png') }}"
                                                    id="logo_preview"
                                                    class="w-100 shadow-1-strong rounded mb-4"
                                                    height="450px"
                                                />

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-12 text-right mt-4">

                                        <a href="{{ route('school-index') }}">
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

        let url_upload_image = '{{ route("multimedia-upload-image") }}';

        let token            = '{{ csrf_token() }}';

        uploadImage( url_upload_image, token );

    </script>

@endsection
