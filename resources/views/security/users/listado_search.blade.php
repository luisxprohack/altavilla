<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm">
        <thead class="bg-secondary">
            <tr>
                <th>Documento</th>
                <th>Datos</th>
            </tr>
        </thead>
        <tbody >
            @forelse($user as $item)
                <tr class="pointer" onclick="selected_user({{ $item->id }},'{{ $item->datos }}')">
                    <td>{{ $item->ndocumento }}</td>
                    <td><span class="badge badge-light">{{ $item->datos }}</span></td>
                </tr>
            @empty
                <tr><td colspan="3"><span class="text-danger">No hay registros con el criterio de busqueda</span></td></tr>
            @endforelse
        </tbody>
    </table>
</div>
