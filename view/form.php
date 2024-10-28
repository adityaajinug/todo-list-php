<form action="index.php?action=<?= isset($edit) ? 'update&id=' . $edit['id'] : 'create'?>" method="post" class="d-flex justify-content-between gap-3">
    <input type="hidden" name="id" value="<?= isset($edit) ? $edit['id'] : ''?>">
    <div class="input-group mb-3">
        <input type="text" class="form-control" name="isi" placeholder="Kegiatan" value="<?= $edit['isi'] ?? ''?>">
    </div>
    <div class="input-group mb-3">
        <input type="date" class="form-control" name="tgl_awal" placeholder="Tanggal Awal" value="<?= $edit['tgl_awal'] ?? ''?>">
    </div>
    <div class="input-group mb-3">
        <input type="date" class="form-control" name="tgl_akhir" placeholder="Tanggal Akhir" value="<?= $edit['tgl_akhir'] ?? ''?>">
    </div>
    <div class="input-group mb-3">
        <button type="submit" class="btn btn-primary rounded-4">Simpan</button>
    </div>
</form>