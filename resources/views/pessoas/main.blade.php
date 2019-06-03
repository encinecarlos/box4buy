@extends('base.base') 

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">            
            <h4><i class="fa fa-user"></i> <span>CLIENTES</span></h4>
            <div class="box-tools pull-right">
                <a href="{{ route('pessoas.add') }}" class="btn pull-right btn-rounded boxColorTema"><i class="fa fa-plus"></i> Adicionar cliente</a>
            </div>
        </div>
        {{-- <div class="box-header with-border">            
            <h3 class="box-title">ADMINISTRAÇÃO DE CLIENTES</h3>
            <div class="box-tools pull-right"></div>
        </div> --}}

        <div class="box-body table-responsive">
            <table class="table table-hover" id="lista-clientes">
                <thead>
                    <tr>                        
                        <th>Suite</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                    </tr>   
                </thead>
                <tbody>
                    @foreach($pessoas as $pessoa)
                    <tr>                        
                        <td>{{ session('suite_prefix') }}{{ $pessoa->codigo_suite }}</td>
                        <td>{{ $pessoa->nome_completo }}</td>
                        <td>{{ $pessoa->email }}</td>                                    
                        <td>
                            <a href="{{ route('pessoas-show', $pessoa->codigo_suite) }}"
                               class="btn btn-default btn-rounded boxColorTema">
                                <i class="fa fa-eye"></i>
                                Ver mais
                            </a> 
                            <button class="btn btn-danger btn-rounded delete-pessoa-{{ $pessoa->codigo_suite }}" type="button" onclick="deletePessoa({{ $pessoa->codigo_suite }})"><i class="fa fa-trash"></i></button>
                        </td>                    
                    </tr>
                    @endforeach
                </tbody>                
                                                
            </table>            
        </div>
    </div>

@stop 

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap.css" />

@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"></script>
    <script>
        $('#lista-clientes').dataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
            },
            order: [[0, 'desc']],
            pageLength: 50
        });

        function deletePessoa(id) {
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
                    axios.delete('/admin/pessoas/delete/' + id).then(response => {
                        Swal.fire({
                            title: 'Sucesso!',
                            text: response.data.msg,
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
