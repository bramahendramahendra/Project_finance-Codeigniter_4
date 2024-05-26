<!-- Main content -->
<section class="content">
    <div class="error-page">
        <h2 class="headline text-danger"><?= $status_code?></h2>
        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-danger"></i> <?=$errors?></h3>
            <p><?=$message?></p>
            <form class="search-form">
                <div class="input-group">
                    <button type="button" class="btn btn-block btn-outline-danger btn-lg" id="btn-back">Kembali</button>
                </div>
            <!-- /.input-group -->
            </form>
        </div>
    </div>
    <!-- /.error-page -->
</section>

<script>
    document.getElementById('btn-back').addEventListener('click', function() {
        window.history.back();
    });
</script>