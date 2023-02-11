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

                        <div class="col-12">
                            <div class="card card-success card-outline">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <label for="name">Nombre: *</label>
                                            <input wire:model="name" type="text" class="form-control form-group">
                                            @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>

{{--                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">--}}
{{--                                            <label for="create-schools">Universidades:</label>--}}
{{--                                            <div class="select2-success form-group" wire:ignore>--}}
{{--                                                <select wire:model="schools" data-model="schools" id="create-schools" class="select2" data-dropdown-css-class="select2-success" multiple="multiple">--}}
{{--                                                    <option value="" selected></option>--}}
{{--                                                    @foreach( $list_schools as $item )--}}
{{--                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>--}}
{{--                                                    @endforeach--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                            @error('schools') <span class="error text-danger">{{ $message }}</span> @enderror--}}
{{--                                        </div>--}}

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <label for="email">Correo electronico: *</label>
                                            <input wire:model="email" type="text" class="form-control form-group" autocomplete="off">
                                            @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                            <label for="password">Password: *</label>
                                            <input wire:model="password" type="password" class="form-control form-group" autocomplete="off">
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                            <label for="password_confirmation">Repetir password: *</label>
                                            <input wire:model="password_confirmation" type="password" class="form-control form-group">
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            @error('password') <span class="error text-danger">{{ $message }}</span> @enderror
                                        </div>

                                    </div>

                                </div>

                            </div>
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
