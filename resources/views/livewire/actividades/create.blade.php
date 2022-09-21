<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear Actividades</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
				<form>
            <div class="form-group">
                <label for="descripcion"></label>
                <input wire:model="descripcion" type="text" class="form-control" id="descripcion" placeholder="Descripcion">@error('descripcion') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="fechaActividad"></label>
                <input wire:model="fechaActividad" type="date" class="form-control" id="fechaActividad" placeholder="Fechaactividad">@error('fechaActividad') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="area"></label>
                <select wire:model="area" type="text" class="form-control" id="area" placeholder="Area">
                    <option value="">Seleccionar Área</option>
                    <option value="TI">Área de Sistemas</option>
                    <option value="Administrativa">Área Administrativa</option>
                    <option value="General">Área General</option>
                </select>
                @error('area') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="idEmpleado"></label>
                <input wire:model="idEmpleado" type="number" class="form-control" id="idEmpleado" placeholder="Idempleado">@error('idEmpleado') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Save</button>
            </div>
        </div>
    </div>
</div>
