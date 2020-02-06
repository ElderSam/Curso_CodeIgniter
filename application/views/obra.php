<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Obras</h4>
                        <p class="category">Lista de Obras</p>
                        <div class="row">
                            <div class="col-sm-10"></div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-novaObra">
                                    NOVA OBRA
                                </button>
                            </div>    
                        </div>
                    </div>

                    <div class="content table-responsive table-full-width">                       
                        <table id="example" class="table table-hover table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Resposavel pela Obra</th>
                                    <th>Telefone</th>
                                    <th>E-mail</th>
                                    <th>Cidade</th>
                                    <th>Data de Cadastro</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Fulano de tal</td>
                                    <td>(19) 3543-3432</td>
                                    <td>hr_construcoes@gmail.com</td>
                                    <td>Piracicaba-SP</td>
                                    <td>22/12/2019</td>
                                    <td>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-obras">
                                    Detalhes
                                    </button>
                                    <input type="button" onclick="deleteRow('.$data->id.')" value="Deletar" class="btn btn-danger">
                                    </td>
                                </tr>
                                
                               
                                </tbody>
                            <tfoot>
                                <tr>
                                    <th>Código</th>
                                    <th>Resposavel pela Obra</th>
                                    <th>Telefone</th>
                                    <th>E-mail</th>
                                    <th>Cidade</th>
                                    <th>Data de Cadastro</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>             
        </div>
    </div>
</div>


