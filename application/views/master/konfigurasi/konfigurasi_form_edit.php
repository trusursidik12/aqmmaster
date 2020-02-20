<div class="container-fluid">
  <br>
  <div class="card">
    <div class="row text-center">
      <div class="col">
        <h3>Update Konfigurasi</h3>
        <hr>
      </div>
    </div>
    <div class="row">
      <div class="col-sm">
        <form role="form" method="post">
          <div class="card-body">
            <div class="form-group">
              <input type="hidden" name="id" value="<?= $alldata['id']; ?>">
              <label class="font-weight-bold">Data :</label>
              <input type="Text" name="data" value="<?= $alldata['data']; ?>" class="form-control <?= form_error('data') == TRUE ? 'is-invalid' : ''; ?>" placeholder="Data *">
              <a style="color: red;"><?= form_error('data') ?></a>
            </div>
            <div class="form-group">
              <label class="font-weight-bold">content :</label>
              <input type="Text" name="content" value="<?= $alldata['content']; ?>" class="form-control" placeholder="Silaka isi content ..">
            </div>
            <div class="form-group">
              <label class="font-weight-bold">Status View (0 atau 1) :</label>
              <input type="Text" name="is_view" value="<?= $alldata['is_view']; ?>" class="form-control" placeholder="Hanya input angka 0 atau 1" >
            </div>
          </div>
          <!-- button -->
          <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
            <button type="reset" class="btn btn-default"><i class="fas fa-sync-alt"></i> Reset</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>