@forelse ($data as $key => $v )
<tr>
        <td>{{ ++$i }}</td>
        <td>{{ $v->name }}</td>
        <td>{{ $v->merk }}</td>
        <td>{{ $v->jenis }}</td>
        <td>
                <ul class="action">
                        {!! Helper::btn_action(1,1,$v->id) !!}
                </ul>
        </td>
</tr>
@empty
<tr>
        <td colspan="6" class="text-center">Data not found</td>
</tr>
@endforelse