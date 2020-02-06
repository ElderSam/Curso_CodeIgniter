<div class="content">
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Clientes</h4>
                    <p class="category">Lista de Clientes</p>
                    <div class="row">
                        <div class="col-sm-9"></div>
                        <div class="col-sm-3">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-novoCliente">
                                NOVO CLIENTE
                            </button>
                        </div>    
                    </div>
                </div>

                <div class="content table-responsive table-full-width">                       
                    <table id="example" class="table table-hover table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>E-mail</th>
                                <th>Cidade</th>
                                <th>Status</th>
                                <th>Ver - Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>HR Construções</td>
                                <td>(19) 3543-3432</td>
                                <td>hr_construcoes@gmail.com</td>
                                <td>Araras-SP</td>
                                <td>Ativo</td>
                                <td>
                                <button type="button" title="ver detalhes" class="btn btn-warning" style="padding: 1px 1px;" data-toggle="modal" data-target="#modal-cliente">
                                <span class="pe-7s-menu" style="font-size: 25px">Ver</span>
                                </button>
                                <button type="button" title="excluir" onclick="deleteRow('.$data->id.')" class="btn btn-danger" style="padding: 1px 1px;">
                                    <span class="pe-7s-trash" style="font-size: 25px">Excluir</span>
                                </button>
                                    
                                </div>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>Famz</td>
                                <td>(16) 3253-1865</td>
                                <td>adm@famz.com</td>
                                <td>Ribeirão Preto-SP</td>
                                <td>Ativo</td>
                                <td>
                                <button type="button" title="ver detalhes" class="btn btn-warning" style="padding: 1px 1px;" data-toggle="modal" data-target="#modal-cliente">
                                <span class="pe-7s-menu" style="font-size: 25px"></span>
                                </button>
                                <button type="button" title="excluir" onclick="deleteRow('.$data->id.')" class="btn btn-danger" style="padding: 1px 1px;">
                                    <span class="pe-7s-trash" style="font-size: 25px"></span>
                                </button>
                                    
                                </div>
                                </td>
                            </tr>
                            
                            
                            </tbody>
                        <tfoot>
                            <tr>
                                <th>Código</th>
                                <th>Name</th>
                                <th>Telefone</th>
                                <th>E-mail</th>
                                <th>Cidade</th>
                                <th>Status</th>
                                <th>Ver - Excluir</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>             
    </div>
</div>
</div>

<!--
<script>
$(document).ready(function() {

$("#linkClientes").addClass("active"); 

$('#example').DataTable();

});

</script>
-->

