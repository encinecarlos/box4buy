<div class="modal fade" id="avalieEntrega">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
			  <h4 class="modal-title text-center">AVALIE A ENTREGA</h4>
			<br>
			<div class="modal-body">
				<form enctype="multipart/form-data" method="POST">
				    <div class="form-group notMarging">
					<br>
				        <label for="avaliacao" class="col-sm-4 control-label aligRight">Avalie sua entrega:</label>
						<div class="col-sm-8 estrelas aligLeft">
							<input type="radio" id="cm_star-empty" name="fb" value="0"/>
							<label for="cm_star-1"><i class="fa"></i></label>
							<input type="radio" id="cm_star-1" name="fb" value="1"/>
							<label for="cm_star-2"><i class="fa"></i></label>
							<input type="radio" id="cm_star-2" name="fb" value="2"/>
							<label for="cm_star-3"><i class="fa"></i></label>
							<input type="radio" id="cm_star-3" name="fb" value="3"/>
							<label for="cm_star-4"><i class="fa"></i></label>
							<input type="radio" id="cm_star-4" name="fb" value="4"/>
							<label for="cm_star-5"><i class="fa"></i></label>
							<input type="radio" id="cm_star-5" name="fb" value="5" checked/>
						</div>
						<br>
					</div>
					<br><br>
					<div class="form-group notMarging">
						<label for="observacao" class="col-sm-4 control-label aligRight">Observações:</label>
						<div class="col-sm-8">
							<textarea type="text" rows="3" class="form-control" id="observacao" placeholder="Observações"></textarea>
						</div>
					</div>
					<br><br>
				</form>
				<br>
			</div>
		</div>
	</div>
</div>