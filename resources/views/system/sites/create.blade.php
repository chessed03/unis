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
                                        <label for="schools">Universidad:</label>
                                        <select name="school_id" id="school_id" class="orm-control form-group select2bs4 @error('school_id') is-invalid @enderror">
                                            <option selected></option>
                                            @foreach( $list_schools as $school )
                                                <option {{ ( $school->id == old('school_id') ?? '' )  ? 'selected' : '' }} value="{{ $school->id }}">{{ $school->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('school_id')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                    </div>

                                    <div class="form-group col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <label>Logo:</label>
                                        <div class="input-group">
                                            <label class="input-group-btn">
                                                <span class="btn btn-primary btn-file elevation-2">
                                                    <i class='bx bx-fw bx-cloud-upload'></i> Cargar imagen <input accept=".jpg,.png,.jpeg,.gif" class="hidden" name="upload_image" type="file" id="upload_image">
                                                </span>
                                            </label>
                                            &nbsp;&nbsp;
                                            <input class="form-control @error('logo_url') is-invalid @enderror" name="logo_url" readonly="readonly" id="logo_url" type="text" value="{{ old('logo_url') }}">
                                            @error('logo_url')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <label for="title">Título del sitio:</label>
                                        <input type="text" name="title" id="address" class="form-control form-group @error('title') is-invalid @enderror" value="{{ old('title') }}">
                                        @error('title')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <label for="base_url">URL:</label>
                                        <input type="text" name="base_url" id="base_url" class="form-control form-group @error('base_url') is-invalid @enderror" value="{{ old('base_url') }}">
                                        @error('base_url')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <label for="server_name">Nombre del servidor:</label>
                                        <input type="text" name="server_name" id="server_name" class="form-control form-group @error('server_name') is-invalid @enderror" value="{{ old('server_name') }}">
                                        @error('server_name')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <label for="social_networks">Redes sociales:</label>
                                        <input type="text" name="social_networks" id="social_networks" class="form-control form-group @error('social_networks') is-invalid @enderror" value="{{ old('social_networks') }}">
                                        @error('social_networks')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <label for="social_networks">Previsualización del logo:</label>
                                        <img src="" id="logo_preview">
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
        $(document).on('change','.btn-file :file',function(){

            let input    = $(this);

            let numFiles = input.get(0).files ? input.get(0).files.length : 1;

            let label    = input.val().replace(/\\/g,'/').replace(/.*\//,'');

            input.trigger('fileselect',[numFiles,label]);

        });

        $('.btn-file :file').on('fileselect',function(event,numFiles,label){

            let input = $(this).parents('.input-group').find(':text');

            let log = numFiles > 1 ? numFiles + ' files selected' : label;

            if (input.length) {

                input.val(log);
                //console.log(input)
            } else {

                if (log) alert(log);
                //console.log(log)
            }

            let url_upload_image = '{{ route("image-upload-image") }}';

            let token            = '{{ csrf_token() }}';

            let form             = new FormData();

            let files            = $('#upload_image')[0].files[0];

            form.append('file',files);
            $.ajax({
                url: url_upload_image, // Set the url
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                data: form,
                contentType: false,
                processData: false,
                success: function(response){
                    console.log(response);

                    $('#logo_url').val(response.location);
                    $("#logo_preview").attr("src",response.location);
                    /*if(response != 0){

                        $("#img").attr("src",response);
                        $(".preview img").show(); // Display image element

                    }else{

                        alert('file not uploaded');

                    }*/
                },
            });
            //console.log(files)
        });

    </script>
@endsection
