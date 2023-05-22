@if($table3)
<tr>
        <td>{{ number_format($table3->exy_2, 2, ',', '.'); }}</td>
        <td>{{ number_format($table3->ex1_2, 2, ',', '.'); }}</td>
        <td>{{ number_format($table3->ex2_2, 2, ',', '.'); }}</td>
        <td>{{ number_format($table3->ex1y, 2, ',', '.'); }}</td>
        <td>{{ number_format($table3->ex2y, 2, ',', '.'); }}</td>
        <td>{{ number_format($table3->ex1x2, 2, ',', '.'); }}</td>
        <td>{{ number_format($table3->b1, 2, ',', '.'); }}</td>
        <td>{{ number_format($table3->b2, 2, ',', '.'); }}</td>
        <td>{{ number_format($table3->a, 2, ',', '.'); }}</td>
        <td>{{ number_format($table3->r, 2, ',', '.'); }}</td>
</tr>
@else
<tr>
        <td colspan="10" class="text-center">Data Kosong</td>
</tr>
@endif