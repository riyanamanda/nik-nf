<table>
    <thead>
    <tr>
        <th>Nama</th>
        <th>NIK</th>
        <th>Pasien atau Nakes</th>
    </tr>
    </thead>
    <tbody>
    @foreach($patients as $patient)
        <tr>
            <td>
                {{ $patient->identitas == null ? 'null' : $patient->identitas->NAMA }}
            </td>
            <td>
                {{ $patient->nik }}
            </td>
            <td>
                Pasien
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
