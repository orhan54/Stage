<?php
session_start();

$user = $_SESSION['user'] ?? null;
$association = $_SESSION['association'] ?? null;

ob_start();
?>

<div class="container-fluid mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow h-100">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0 fs-4 text-center">Ajouter un Événement</h2>
                </div>
                <div class="card-body p-4">
                    <form id="eventForm" action="../../index.php?route=evenement" method="POST"
                        enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="evenement_titre" class="form-label fw-bold">Titre de l'événement</label>
                            <input type="text" class="form-control" id="evenement_titre" name="evenement_titre"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="evenement_description" class="form-label fw-bold">Description de
                                l'événement</label>
                            <textarea class="form-control" id="evenement_description" name="evenement_description"
                                rows="4" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="evenement_date" class="form-label fw-bold">Date de l'événement</label>
                            <input type="date" class="form-control" id="evenement_date" name="evenement_date" required>
                        </div>

                        <div class="mb-4">
                            <label for="Id_villeFR" class="form-label fw-bold">Ville</label>
                            <input type="text" class="form-control" id="Id_villeFR" name="Id_villeFR"
                                placeholder="Entrez le nom de la ville" required>
                        </div>

                        <div class="mb-3">
                            <label for="evenement_photo" class="form-label fw-bold">Photo de l'événement</label>
                            <input type="file" class="form-control" id="evenement_photo" name="evenement_photo"
                                accept="image/*">
                            <div class="form-text">Formats acceptés : JPG, PNG, GIF (max 5 Mo)</div>
                        </div>

                        <div class="mb-4">
                            <label for="evenement_video" class="form-label fw-bold">Vidéo de l'événement</label>
                            <input type="file" class="form-control" id="evenement_video" name="evenement_video"
                                accept="video/*">
                            <div class="form-text">Formats acceptés : MP4, MOV, AVI (max 50 Mo)</div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include("layout.php");
?>