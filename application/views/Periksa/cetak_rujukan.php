<!DOCTYPE html>
<html>
<head>
	<title>Rujukan <?php echo @$data->nmPst; ?></title>
	<style type="text/css">
	@font-face {
		font-family: "Bar-Code 39";
		src: url('<?php echo base_url('desain/Code39.ttf') ?>');
	}
	.barcode {
		text-align: right;
		font-size: 30px;
		font-family: "Bar-Code 39";
		padding-right: 30px
	}

	.row {
    display: grid;
    grid-template-columns: repeat(12, 1fr);
}

@media (min-width: 992px) {
    .col {
        grid-column: span 6;
    }
}

	table>tr>td{ padding: 50px !important; }
	body { font-size: 18px; font-family: "Arial"; }
	tr { margin-top :100px !important;}

	</style>
</head>
<body style="font-family: Times New Roman;" >
	<table width="100%" >
		<tr >
			<td valign="midle" width="50%">
				<img width="300" height="50" src="<?php echo base_url('desain/bpjs.png') ?>" >
			</td>
			<td valign="top">
				<b style="width: 30px">Divisi Regional </b> &nbsp;&nbsp; <?php echo @$data->ppk->kc->kdKR->nmKR ?><br>
				<b style="width: 30px">Kantor Cabang </b> &nbsp;&nbsp;JEMBER
			</td>
		</tr>
	</table>
	<br><br>
	<center><b style="font-size:12px;">Surat Rujukan FKTP</b></center>
	<div style="width: 95%; padding: 15px; border: 1px solid;margin-top: 5px;margin-right:50px; font-size:12px">
		<div style="width: 92%; border: 1px solid;padding: 10px; margin-bottom: 15px">
			<table width="100%" style="font-size:12px">
				<tr>
					<td>No. Rujukan</td>
					<td>:</td>
					<td><?php echo @$data->noRujukan; ?></td>
					<td class="barcode" rowspan="10" width="50%" valign="midle"><?php echo @$data->noRujukan; ?>
					</td>
				</tr>
				<tr>
					<td>FKTP</td>
					<td>:</td>
					<td><?php echo @$data->ppk->nmPPK." (".@$data->ppk->kdPPK.")"; ?></td>
				</tr>
				<tr>
					<td>Kabupaten/Kota</td>
					<td>:</td>
					<td><?php echo @$data->ppk->kc->dati->nmDati." (".@$data->ppk->kc->dati->kdDati.")"; ?></td>
				</tr>
			</table>
		</div>
		<table width="100%" style="font-size:12px">
			<tr>
				<td>Kepada Yth. TS dr. Poli</td>
				<td colspan="2">: <?php echo @$data->poli->nmPoli?></td>
			</tr>
			<tr>
				<td>Di RSU</td>
				<td colspan="2">: <?php echo $kunjungan['rs_rujuk']; ?></td>
			</tr>
			<tr>
				<td colspan="3"></td>
			</tr>
			<tr>
				<td colspan="3"></td>
			</tr>
			<tr>
				<td colspan="3"></td>
			</tr>
			<tr>
				<td colspan="3"></td>
			</tr>
			<tr>
				<td colspan="3"></td>
			</tr>
			<tr>
				<td colspan="3"></td>
			</tr>
			<tr>
				<td colspan="3">Mohon pemeriksaan dan penanganan lebih lanjut penderita :</td>
			</tr>
			<tr>
				<td colspan="3"></td>
			</tr>
			<tr>
				<td colspan="3"></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td >: <?php echo @$data->nmPst; ?></td>
				<td rowspan="2">
					<table width="100%" style="font-size:12px">
						<tr>
							<td>Umur</td>
							<td>: <?php echo date('Y')-date('Y',strtotime(@$data->tglLahir))-1; ?></td>
							<td>Tahun</td>
							<td>: <?php echo date('d-M-Y',strtotime(@$data->tglLahir)) ?></td>
						</tr>
						<tr>
							<td>Status</td>
							<td>: <div style="border: 1px solid; padding: 2px 7px; display: inline;"><?php echo @$data->pisa ?></div></td>
							<td>Utama/Tanggungan</td>
							<td>: <div style="border: 1px solid; padding: 2px 7px; display: inline;"><?php echo @$data->sex ?></div> (L/P)</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>No. Kartu BPJS</td>
				<td>: <?php echo @$data->nokaPst; ?></td>
			</tr>
			<tr>
				<td>Diagnosa</td>
				<td colspan="3">: <?php echo @@$data->diag1->nmDiag." (".@@$data->diag1->kdDiag.")";
					if (!empty(@$data->diag2)) {
						echo ",";
						echo @@$data->diag2->nmDiag." (".@@$data->diag2->kdDiag.")";
					}
					if (!empty(@$data->diag3)) {
						echo ",";
						echo @@$data->diag3->nmDiag." (".@@$data->diag3->kdDiag.")";
					}
					?></td>
				</tr>
				<tr>
					<td>Telah diberikan</td>
					<td colspan="3">: -</td>
				</tr>
			</table><br><br>
			Demikian atas bantuannya, diucapkan banyak terima kasih.<br><br>
			<table width="100%">
				<tr>
					<td style="text-align: left;">
							Tgl. Rencana Berkunjung : <?php echo date("d-M-Y",strtotime($kunjungan['tgl_rujuk']))?>
							<div style="height: 5px"></div>
							Jadwal Praktek : <?php echo $kunjungan['jadwal_rs']?>
							<div style="height: 5px"></div>
							<?php
							$tgl_masa_berlaku = date_create($kunjungan['tgl_rujuk']);
							date_add($tgl_masa_berlaku, date_interval_create_from_date_string("90 day"));
							?>
							Surat Rujukan Berlaku 1 [satu] kali kunjungan, berlaku sampai dengan : <?php echo date_format($tgl_masa_berlaku, "d-M-Y");?>
					</td>
					<td rowspan="3"> </td>
					<td style="text-align: right;">
							Salam sejawat, <?php echo date('d F Y'); ?>
							<div style="height: 30px"></div>
							<?php echo @$data->dokter->nmDokter; ?>
					</td>
				</tr>
			</table>
		</div>
		<div style="width: 95%; padding: 15px; border: 1px solid;margin-right:50px;">
			<center><b style="font-size: 12px;"><u>SURAT RUJUKAN BALIK</u></b></center><br><br>
			<div style="text-align: left;margin-bottom:20px; font-size:12px;">
				Teman sejawat Yth.
				<div style="height: 5px; font-size:12px;"></div>
				Mohon kontrol selanjutnya penderita :
			</div>
			<table width="80%" style="margin-left:100px; font-size:12px;">
				<tr >
					<td colspan="2">Nama</td>
					<td>: <?php echo @$data->nmPst; ?><td>
					</tr>
					<tr >
						<td colspan="2">Diagnosa</td>
						<td>: .................................................................................................<td>
						</tr>
						<tr>
							<td colspan="2">Terapi</td>
							<td>: .................................................................................................<td>
							</tr>
						</table><br><br>
						<table width="100%" style="font-size:12px" >
							<tr>
								<td width="10%"><div style="height:20px;width:50px;border:1px solid black"></div></td>
								<td width="40%">Pengobatan Dengan Obat-Obatan:
									<br>.......................................................
								</td>
								<td width="10%"></td>
								<td width="10%"><div style="height:20px;width:50px;border:1px solid black"></div></td>
								<td width="30%">Perlu Rawat Inap</td>
							</tr>
							<tr>
								<td width="10%"><div style="height:20px;width:50px;border:1px solid black"></div></td>
								<td width="40%">Kontrol Kembali Ke RS Tanggal :
									<br>.......................................................
								</td>
								<td width="10%"></td>
								<td width="10%"><div style="height:20px;width:50px;border:1px solid black"></div></td>
								<td width="30%">Konsultasi Selesai</td>
							</tr>
							<tr>
								<td width="10%"><div style="height:20px;width:50px;border:1px solid black"></div></td>
								<td width="40%">Lain-Lain:
									<br>.......................................................
								</td>
								<td width="10%"></td>
								<td width="40%" colspan="2">.................................tgl..............................</td>
							</tr>
						</table>
						<div style="text-align: right; font-size:12px">
							<span style="margin-right:100px">Dokter RS</span>
							<div style="height: 30px"></div>
							(......................................................)
						</div>
					</div>

				</body>
				</html>
				<script src="<?php echo base_url(); ?>desain/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
				<script>
					$(document).ready(function(){
						window.print()
					});
				</script>
