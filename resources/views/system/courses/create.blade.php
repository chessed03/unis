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

                                <h6>Crear curso</h6>

                                <a href="{{ route('course-index') }}">
                                    <button type="button" class="btn btn-info elevation-2">
                                        <i class="bx bx-fw bx-chevron-left-circle"></i> Regresar
                                    </button>
                                </a>

                            </div>

                        </div>

                        <div class="card-body">

                            <form action="{{ route('course-save-create') }}" method="POST">

                                @csrf

                                <div class="row">

                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">

                                        <div class="row">

                                            {{--<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                <label for="schools">Universidad:</label>
                                                <select name="school_id" id="school_id" class="form-control select2bs4 @error('school_id') is-invalid @enderror">
                                                    <option selected></option>
                                                    @foreach( $list_schools as $school )
                                                        <option {{ ( $school->id == old('school_id') ?? '' )  ? 'selected' : '' }} value="{{ $school->id }}">{{ $school->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('school_id')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                            </div>--}}

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                <label for="name">Nombre del curso:</label>
                                                <input type="text" name="name" id="address" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                                @error('name')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                <label for="description">Descripción:</label>
                                                <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}">
                                                @error('description')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                <label for="start_date">Fecha de inicio:</label>
                                                <input type="text" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}">
                                                @error('start_date')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                <label for="finish_date">Fecha de cierre:</label>
                                                <input type="text" name="finish_date" id="finish_date" class="form-control @error('finish_date') is-invalid @enderror" value="{{ old('finish_date') }}">
                                                @error('finish_date')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group custom-control custom-checkbox">
                                                <input class="custom-control-input custom-control-input-success custom-control-input-outline" type="checkbox" name="launch_notice" id="launch_notice">
                                                <label for="launch_notice" class="custom-control-label">Crear noticia</label>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-12 text-right mt-4">

                                        <a href="{{ route('course-index') }}">
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
