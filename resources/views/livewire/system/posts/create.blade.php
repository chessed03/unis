<div wire:ignore.self id="createModal" data-backdrop="static" class="modal fade create-modal" role="dialog">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content ">

            <div class="modal-header" style="background-color: #E5E5E5;">

                <h6>Crear</h6>

                <button type="button" wire:click.prevent="cancel()" class="close" data-dismiss="modal"><i class='bx bx-x-circle'></i></button>

            </div>

            <div class="modal-body">

                <p class="sub-header form-group">
                    *Campos requeridos.
                </p>

                <form>

                    <div class="row">

                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <label for="title">Titulo:</label>
                            <input wire:model="title" wire:keyup="generateSlug" type="text" class="form-control form-group">
                            @error('title') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <label for="slug">Slug:</label>
                            <input wire:model="slug" type="text" class="form-control form-group">
                            @error('slug') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <label for="subtitle">Subtitulo:</label>
                            <input wire:model="subtitle" type="text" class="form-control form-group">
                            @error('subtitle') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <label for="schools">Universidades:</label>
                            <div class="select2-success form-group" wire:ignore>
                            <select wire:model="schools" id="create-schools" data-model="schools" class="select2" data-dropdown-css-class="select2-success" multiple="multiple">
                                @foreach( $items_schools as $item )
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                            @error('schools') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div wire:ignore class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <label for="content">Contenido:</label>
                            <textarea class="form-control form-group" id="tiny-editor-create"></textarea>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            @error('content') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                    </div>

                </form>

            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-danger" data-dismiss="modal"><i class='bx-fw bx bx-x-circle'></i> Cerrar</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-success"><i class='bx-fw bx bx-save'></i> Guardar</button>
            </div>

        </div>

    </div>

</div>

@push('js')

    <script>

        let upload_image_create = '{{ route("post-upload-image") }}';

        let token_create               = '{{ csrf_token() }}';

        tinymce.init({
            height : "440",
            selector: 'textarea#tiny-editor-create',
            language: "es_MX",
            plugins: [
                'image code',
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table paste"
            ],
            toolbar:
                "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code | table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol",
            forced_root_block: false,
            image_title: true,
            automatic_uploads: true,
            images_upload_url: upload_image_create,
            file_picker_types: 'image',
            images_upload_handler: function(blobInfo, success, failure) {

                let xhr, formData;

                xhr = new XMLHttpRequest();

                xhr.withCredentials = false;

                xhr.open('POST', upload_image_create);

                xhr.setRequestHeader("X-CSRF-Token", token_create);

                xhr.onload = function() {

                    let json;

                    if (xhr.status != 200) {

                        failure('HTTP Error: ' + xhr.status);

                        return;

                    }

                    json = JSON.parse(xhr.responseText);

                    console.log("response is ", json)

                    if (!json || typeof json.location != 'string') {

                        failure('Invalid JSON: ' + xhr.responseText);

                        return;

                    }

                    success(json.location);

                };

                formData = new FormData();

                formData.append('file', blobInfo.blob(), blobInfo.filename());

                xhr.send(formData);
            },
            setup: function (editor) {

                editor.on('init', function (e) {

                    Livewire.on('content', content => {

                        editor.setContent(content);

                        @this.set('content', content);

                    });

                });

                editor.on('init change', function () {

                    editor.save();

                });

                editor.on('change', function (e) {

                    @this.set('content', editor.getContent());

                });

            }
        });

    </script>

@endpush
