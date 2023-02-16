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

                                <h6>Crear universidad</h6>

                                <a href="{{ route('school-index') }}">
                                    <button type="button" class="btn btn-info elevation-2">
                                        <i class="bx bx-fw bx-chevron-left-circle"></i> Regresar
                                    </button>
                                </a>

                            </div>

                        </div>

                        <div class="card-body">

                            <form action="{{ route('school-save-create') }}" method="POST">

                                @csrf

                                <div class="row">

                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <label for="name">Nombre:</label>
                                        <input type="text" name="name" id="name" class="form-control form-group @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                        @error('name')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <label for="address">Dirección:</label>
                                        <input type="text" name="address" id="address" class="form-control form-group @error('address') is-invalid @enderror" value="{{ old('address') }}">
                                        @error('address')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <label for="contact">Contacto:</label>
                                        <input type="text" name="contact" id="contact" class="form-control form-group @error('contact') is-invalid @enderror" value="{{ old('contact') }}">
                                        @error('contact')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <label for="phone">Telefono:</label>
                                        <input type="text" name="phone" id="phone" class="form-control form-group @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                                        @error('phone')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <label for="email">Correo:</label>
                                        <input type="text" name="email" id="email" class="form-control form-group @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                        @error('email')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <label for="description">Descripción:</label>
                                        <input type="text" name="description" id="description" class="form-control form-group @error('description') is-invalid @enderror" value="{{ old('description') }}">
                                        @error('description')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
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
