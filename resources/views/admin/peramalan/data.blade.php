@forelse ($table1 as $key => $v )
<tr>
        <td>{{ ++$i }}</td>
        <td>{{ Helper::toDateString($v->tanggal) }}</td>
        <td>{{ number_format($v->stock, 0, ',', '.'); }}</td>
        <td>{{ number_format($v->transaction, 0, ',', '.'); }}</td>
        <td>{{ number_format($v->visitor, 0, ',', '.'); }}</td>
        <td>{{ number_format($v->y_2, 0, ',', '.'); }}</td>
        <td>{{ number_format($v->x1_2, 0, ',', '.'); }}</td>
        <td>{{ number_format($v->x2_2, 0, ',', '.'); }}</td>
        <td>{{ number_format($v->x1y, 0, ',', '.'); }}</td>
        <td>{{ number_format($v->x2y, 0, ',', '.'); }}</td>
        <td>{{ number_format($v->x1x2, 0, ',', '.'); }}</td>
</tr>
@empty
<tr>
        <td colspan="11" class="text-center">Data Kosong</td>
</tr>
@endforelse