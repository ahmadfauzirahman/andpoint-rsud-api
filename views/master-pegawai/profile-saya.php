<?php

/* @var $this yii\web\View */

use app\components\Helper;
use yii\helpers\Url;

$this->title = 'Profile Media Management';
?>
<div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card">
            <div class="card-header" style="background: #fff;">
                <h3 class="card-title"><i class="fa fa-user mr-2"></i> Profile Saya</h3>
            </div>
            <div class="card-body box-profile">
                <div class="text-center">
                    <img src="<?= Url::to('@web/img/user.png') ?>" class="profile-user-img img-fluid img-circle" alt="Michael E. Quinn">
                </div>
                <h3 class="profile-username text-center"><?= Yii::$app->user->identity->nama ?></h3>
                <p class="text-muted text-center"><?= Yii::$app->user->identity->roles ?></p>
                <a class="btn btn-outline-primary btn-block" href="#"><i class="fa fa-envelope mr-2"></i>
                    Email Belum Ada </a>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <br>
        <!-- About Me Box -->
        <div class="card">
            <div class="card-header" style="background: #fff;">
                <h3 class="card-title"><i class="fa fa-list mr-2"></i>Custom Fields</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <strong>Phone</strong>
                <p class="text-muted">
                    No Hp Belum Ada </p>
                <hr> <strong>Address</strong>
                <p class="text-muted">
                    Alamat Belum Ada </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="clearfix"></div>
        <div class="card">
            <div class="card-header" style="background: #fff;">
                <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="fa fa-cog mr-2"></i>Settings</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <form method="POST" action="/web/pengguna/update-profile" accept-charset="UTF-8"><input name="_method" type="hidden" value="PATCH"><input name="_token" type="hidden" value="IRPToyhE12Msc5A2ghRmzZjClN8elWhWXzS35Od6">
                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="col-12 pb-4">Biodata Diri</h5>
                            <input type="hidden" name="Pengguna[u_id]" value="33">
                            <div style="flex: 30%;max-width: 100%;padding: 0 4px;" class="column">
                                <!-- Name Field -->
                                <div class="form-group row ">
                                    <label for="name" class="col-3 control-label text-right">Nip/Nik</label>
                                    <div class="col-9">
                                        <input class="form-control" placeholder="Insert Name" name="Pengguna[u_nama]" readonly type="text" value="<?= Yii::$app->user->identity->kodeAkun ?>" id="name">
                                        <div class="form-text text-muted">
                                            Nip Pegawai </div>
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <label for="name" class="col-3 control-label text-right">Nama Lengkap dan Gelar</label>
                                    <div class="col-9">
                                        <input class="form-control" placeholder="Kode Stakeholder" name="Pengguna[u_username]" readonly type="text" value="<?= $modelPegawai->nama_lengkap . " " . $modelPegawai->gelar_sarjana_belakang ?>" id="name">
                                        <div class="form-text text-muted">
                                            Nama Lengkap </div>
                                    </div>
                                </div>

                                <!-- Email Field -->
                                <div class="form-group row ">
                                    <label for="email" class="col-3 control-label text-right">Tempat Lahir</label>
                                    <div class="col-9">
                                        <input class="form-control" readonly placeholder="Insert Email" name="Pengguna[u_email]" type="text" value="<?= $modelPegawai->tempat_lahir  ?>" id="email">
                                        <div class="form-text text-muted">
                                            Tempat Lahir </div>
                                    </div>
                                </div>

                                <!-- Password Field -->
                                <div class="form-group row ">
                                    <label for="password" class="col-3 control-label text-right">Status Perkawinan</label>
                                    <div class="col-9">
                                        <input class="form-control" placeholder="Insert Password" name="Pengguna[u_password]" type="text" value="<?= $modelPegawai->status_perkawinan  ?>" readonly id="password">
                                        <div class="form-text text-muted">
                                            Status </div>
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label for="password" class="col-3 control-label text-right">Agama</label>
                                    <div class="col-9">
                                        <input class="form-control" placeholder="Insert Password" name="Pengguna[u_password]" type="text" value="<?= $modelPegawai->reg->agama  ?>" readonly id="password">
                                        <div class="form-text text-muted">
                                            Agama </div>
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label for="password" class="col-3 control-label text-right">Alamat Tempat Tinggal</label>
                                    <div class="col-9">
                                        <input class="form-control" placeholder="Insert Password" name="Pengguna[u_password]" type="text" value="<?= $modelPegawai->alamat_tempat_tinggal  ?>" readonly id="password">
                                        <div class="form-text text-muted">
                                            Alamat Sekarang </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-12">

                            <div class="clearfix"></div>
                            <div class="col-12 custom-field-container">
                                <h5 class="col-12 pb-4">Penempatan Unit Kerja Sekarang</h5>
                                <div style="flex: 50%;max-width: 100%;padding: 0 4px;" class="column">
                                    <!-- $FIELD_NAME_TITLE$ Field -->
                                    <div class="form-group row ">
                                        <label for="phone" class="col-3 control-label text-right">Rumpun</label>
                                        <div class="col-9">
                                            <input class="form-control" readonly placeholder="+1 553 459 632" name="Pengguna[phone]" type="text" value="<?= $model->rum->nama ?>" id="phone">
                                            <div class="form-text text-muted">
                                                SDM RUMPUN
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div style="flex: 50%;max-width: 100%;padding: 0 4px;" class="column">

                                    <!-- $FIELD_NAME_TITLE$ Field -->
                                    <div class="form-group row ">
                                        <label for="address" class="col-3 control-label text-right">Sub Rumpun</label>
                                        <div class="col-9">
                                            <input class="form-control" readonly placeholder="Address here" name="Pengguna[address]" type="text" value="<?= $model->subrumpun->nama ?>" id="address">
                                            <div class="form-text text-muted">
                                                SDM SUB RUMPUN
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="flex: 10%;max-width:100%;padding: 0 4px;" class="column">

                                    <!-- $FIELD_NAME_TITLE$ Field -->
                                    <div class="form-group row ">
                                        <label for="address" class="col-3 control-label text-right">Unit Kerja</label>
                                        <div class="col-9">
                                            <input class="form-control" readonly placeholder="Address here" name="Pengguna[address]" type="text" value="<?= $model->unit->nama ?>" id="address">
                                            <div class="form-text text-muted">
                                                SDM SUB RUMPUN
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Field -->
                        <div style="display: none;" class="form-group col-12 text-right">
                            <input type="hidden" name="_csrf" value="rRfmDlHE6OttHbUoyLwUcaujaGnL5IU0SAmg9YzOqZbjfJBCCPCe3xUo6nKa0lo1_cc6I4iswH0hbPnEv4rExg==">

                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save User</button>
                            <a href="#" class="btn btn-default"><i class="fa fa-undo"></i> Cancel</a>
                        </div>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>