

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title">Faturas</h4>
						<p class="category">Lista de Faturas</p>
					</div>
					<div class="content table-responsive table-full-width">
						<table class="table table-hover table-striped">
							<thead>
								<th>Nº</th>
								<th>Emissão</th>
								<th>Vencimento</th>
								<th>Cliente</th>
								<th>Valor</th>
								<th>Status</th>
								<th>Opções</th>
							</thead>
							<tbody>
								<tr>
									<td>144</td>
									<td>23/11/2019</td>
									<td>11/12/2019</td>
									<td>Niger X</td>
									<td>R$ 409,50</td>
									<td class="text-danger">Vencida</td>
									<td>
										<input type="button" onclick="viewORedit('.$data->id.', \'view\')" value="View" class="btn btn-warning">	
										<input type="button" onclick="viewORedit('.$data->id.', \'edit\')" value="Edit" class="btn btn-primary">
										<input type="button" onclick="deleteRow('.$data->id.')" value="Delete" class="btn btn-danger">
									</td>
								</tr>
								<tr>
									<td>145</td>
									<td>05/12/2019</td>
									<td>12/12/2019</td>
									<td>HR Construções</td>
									<td>R$ 670,00</td>
									<td>Pendente</td>
									<td>
										<input type="button" onclick="viewORedit('.$data->id.', \'view\')" value="View" class="btn btn-warning">	
										<input type="button" onclick="viewORedit('.$data->id.', \'edit\')" value="Edit" class="btn btn-primary">
										<input type="button" onclick="deleteRow('.$data->id.')" value="Delete" class="btn btn-danger">
									</td>
								</tr>
								<tr>
									<td>143</td>
									<td>01/11/2019</td>
									<td>18/11/2019</td>
									<td>Nestlé</td>
									<td>R$ 1.909,80</td>
									<td>Paga</td>
									<td>
										<input type="button" onclick="viewORedit('.$data->id.', \'view\')" value="View" class="btn btn-warning">	
										<input type="button" onclick="viewORedit('.$data->id.', \'edit\')" value="Edit" class="btn btn-primary">
										<input type="button" onclick="deleteRow('.$data->id.')" value="Delete" class="btn btn-danger">
									</td>
								</tr>
								
								
							</tbody>
						</table>

					</div>
				</div>
			</div>


		</div>
	</div>
</div>


