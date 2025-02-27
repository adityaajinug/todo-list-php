<?php
require_once __DIR__ . '/../app/TodoListApp.php';


use App\TodoListApp;
    
$todoClass = new TodoListApp();

$data = $todoClass->index();

if (isset($_GET['action']) && $_GET['action'] == 'updateStatus' && isset($_GET['id'])) {
    $newStatus = $todoClass->updateStatus($_GET['id']);
    header('Location: index.php');
    exit();

} elseif($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'create') {
    $isi = $_POST['isi'] ?? '';
    $tgl_awal = $_POST['tgl_awal'] ?? '';
    $tgl_akhir = $_POST['tgl_akhir'] ?? '';

    $create = $todoClass->create($isi, $tgl_awal, $tgl_akhir);
    
    header('Location: index.php?message=' .($create ? 'success' : 'failed'));
    exit();

} elseif(isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $edit = $todoClass->edit($id);

} elseif($_SERVER['REQUEST_METHOD'] === 'PUT' && $_GET['action'] === 'update') {
    $id = $_POST['id'] ?? '';
    $isi = $_POST['isi'] ?? '';
    $tgl_awal = $_POST['tgl_awal'] ?? '';
    $tgl_akhir = $_POST['tgl_akhir'] ?? '';

    $update = $todoClass->update($id, $isi, $tgl_awal, $tgl_akhir);

    header('Location: index.php?message=' .($update ? 'success' : 'failed'));
    exit();
    
} elseif(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete = $todoClass->delete($id);

    header('Location: index.php?message=' .($delete ? 'success' : 'failed'));
    exit();
}
?>

<section id="todo-list" class="mt-5">
    <div class="container">
        <h2>To Do List <span class="text-muted">Catat Semua hal yang kamu kerjakan disini</span></h2>
        <hr>
        <?php require_once 'view/form.php'; ?>
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kegiatan</th>
                        <th>Awal</th>
                        <th>Akhir</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $index => $row) :?>
                    <tr>
                        <td><?= $index+1 ?></td>
                        <td><?= $row['isi'] ?></td>
                        <td><?= $row['tgl_awal'] ?></td>
                        <td><?= $row['tgl_akhir'] ?></td>
                        <td>
                            <a href="index.php?action=updateStatus&id=<?= $row['id'] ?>" type="button" class="btn <?= $todoClass->getStatusClass($row['status']) ?> rounded-5">
                                <?= $todoClass->getStatus($row['status']) ?>
                            </a>
                        </td>
                        <td>
                            <a href="index.php?action=edit&id=<?= $row['id'] ?>" class="btn btn-success rounded-5">Ubah</a>
                            <a href="index.php?action=delete&id=<?= $row['id'] ?>" class="btn btn-danger rounded-5" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>