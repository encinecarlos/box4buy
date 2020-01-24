@extends('base.base')

@section('content')
    <div class="box box-info">
        <div class="box-header">
            <h4>ANUNCIOS POSTADOS</h4>
            <div class="box-tools">
                <a href="{{ route('alerts.add') }}" class="btn btn-default btn-rounded boxColorTema">
                    <i class="fa fa-plus"></i>
                    Novo Anúncio
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-hover" id="lista-alerts">
                    <thead>
                        <th>ID</th>
                        <th>Descricçao</th>
                        <th>data de publicação</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($alerts as $alert)
                            <tr>
                                <td>{{ $alert->sequencia }}</td>
                                <td>{{ $alert->title }}</td>
                                <td>{{ $alert->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('alerts.edit', $alert->sequencia) }}" class="btn btn-default btn-rounded boxColorTema">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button type="button" onclick="deleteRegistro({{ $alert->sequencia }})" class="btn btn-danger btn-rounded">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap.css" />
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"></script>
    <script>
        $('#lista-alerts').dataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
            },
            order: [[0, 'desc']],
            pageLength: 50
        });

        function deleteRegistro(id) {
            console.log(id);
            Swal.fire({
                title: 'Você tem certeza disso?',
                text: 'Deseja deletar este registro?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim',
                confirmButtonColor: '#d33',
                cancelButtonText: 'Não',
            }).then(result => {
                if (result.value) {
                    axios.delete('/admin/alerts/delete/' + id).then(response => {
                        Swal.fire({
                            title: 'Tudo certo',
                            text: response.data,
                            type: 'success',
                            confirmButtonText: 'OK',
                            onClose: reloadPage
                        });
                    });
                }
            });

        }

        function reloadPage() {
            location.href = location.href;
        }
    </script>
@endsection
