@forelse ($predict as $key => $v )
<tr>
        <td>{{ ++$i }}</td>
        <td>{{ Helper::toDateString($v->date) }}</td>
        <td>{{ number_format(round($v->stock), 0, ',', '.') }}</td>
</tr>
@empty
<tr>
        <td colspan="3" class="text-center">Data Kosong</td>
</tr>
@endforelse