<?php

class Keluarga
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function generateCodeKeluarga($ids){
        $data = [];
        $inisial_sektor = $ids;
        $qry = "SELECT * FROM tbl_sektor WHERE inisial_sektor = '$inisial_sektor'";
        $res = mysqli_query($this->conn, $qry);
        $row = mysqli_fetch_assoc($res);
        $nama_sektor = $row['nama_sektor'];
        $kd_sektor = $row['kd_sektor'];
        
        $qry_kel = "SELECT COUNT(*) as total FROM tbl_keluarga WHERE kd_sektor = $kd_sektor ORDER BY kd_keluarga DESC LIMIT 1";
        // echo $qry_kel;
        $res = mysqli_query($this->conn, $qry_kel);
        
        // Mengambil hasil query
        $last_id_kel = 0;
        if ($res && mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            $last_id_kel = intval($row['total']);
        }
        
        $next_id = $last_id_kel + 1;
        $kode_keluarga = $inisial_sektor . str_pad($next_id, 3, '0', STR_PAD_LEFT);

        $data['nama_sektor'] = $nama_sektor;
        $data['kd_sektor'] = $kd_sektor;
        $data['kode_keluarga'] = $kode_keluarga;
    
        return $data;
    }
    
    public function insertDataKeluarga($post){
        parse_str($post, $data);

        $nama_keluarga = mysqli_real_escape_string($this->conn, $data['nama_keluarga']);
        $alamat_keluarga = mysqli_real_escape_string($this->conn, $data['alamat_keluarga']);
        $created_date = date('Y-m-d H:i:S');
        $kd_sektor = mysqli_real_escape_string($this->conn, $data['kd_sektor']);
        $nama_anggota = $data['nama_anggota'];
        $jenis_kelamin = $data['jenis_kelamin'];
        $status_hubungan = $data['status_hubungan'];

        if($data['act'] == 'do_add'){   
            $kd_ref_keluarga = mysqli_real_escape_string($this->conn, $data['kd_ref_keluarga']);
            $qry = "INSERT INTO tbl_keluarga (kd_keluarga, kd_ref_keluarga, nama_keluarga, alamat_keluarga, kd_sektor, created_at) VALUES ('', '$kd_ref_keluarga', '$nama_keluarga', '$alamat_keluarga', $kd_sektor, '$created_date')";      
            $ret = mysqli_query($this->conn, $qry);
            $kd_keluarga_last = mysqli_insert_id($this->conn);
            
            for ($i = 0; $i < count($nama_anggota); $i++) {
                $nama = $nama_anggota[$i];
                $kelamin = $jenis_kelamin[$i];
                $status = $status_hubungan[$i];
                $kueri = "INSERT INTO tbl_anggota_keluarga (kd_keluarga, nama_anggota, jenis_kelamin, status_hubungan, created_at, updated_at) VALUES ($kd_keluarga_last, '$nama', '$kelamin', '$status', '$created_date', null)";
                // echo $kueri.'<br>'; die();
                $ret = mysqli_query($this->conn, $kueri);
            }
        } else if($data['act'] == 'do_update'){
            $kd_ref_keluarga = mysqli_real_escape_string($this->conn, $data['kode_ref']);
            $kd_keluarga = mysqli_real_escape_string($this->conn, $data['kd_keluarga']);
            $qry = "UPDATE tbl_keluarga SET kd_ref_keluarga = '$kd_ref_keluarga', nama_keluarga = '$nama_keluarga', alamat_keluarga = '$alamat_keluarga', updated_at = '$created_date' WHERE kd_keluarga = $kd_keluarga";      
            $ret = mysqli_query($this->conn, $qry);

            for ($i = 0; $i < count($nama_anggota); $i++) {
                $nama = $nama_anggota[$i];
                $kelamin = $jenis_kelamin[$i];
                $status = $status_hubungan[$i];

                // Check if the member exists in the database
                if(isset($data['kd_anggota'][$i])){
                    $kd_anggota = $data['kd_anggota'][$i];
                    $kueri = "UPDATE tbl_anggota_keluarga SET nama_anggota = '$nama', jenis_kelamin = '$kelamin', status_hubungan = '$status', updated_at = '$created_date' WHERE kd_anggota = $kd_anggota";
                } else {
                    $kueri = "INSERT INTO tbl_anggota_keluarga (kd_keluarga, nama_anggota, jenis_kelamin, status_hubungan, created_at) VALUES ($kd_keluarga, '$nama', '$kelamin', '$status', '$created_date')";
                }

                $ret = mysqli_query($this->conn, $kueri);
            }
        }
    
        if($ret){
            if($data['act']== 'do_add'){
                return ['status' => 'success', 'message' => 'Keluarga ' . $nama_keluarga . ' berhasil ditambahkan'];
            } else if($data['act']== 'do_update'){
                return ['status' => 'success', 'message' => 'Keluarga ' . $nama_keluarga . ' berhasil diperbarui'];
            }
        } else {
            if($data['act'] == 'do_add'){
                return ['status' => 'error', 'message' => 'Terjadi kesalahan saat menambahkan data'];
            } else if($data['act'] == 'do_update'){
                return ['status' => 'error', 'message' => 'Terjadi kesalahan saat memperbarui data'];
            }
        }
    }

    public function getAllKeluarga($kdsektor){
        $qry = "SELECT 
            k.kd_keluarga,
            k.kd_ref_keluarga,
            k.nama_keluarga,
            k.kd_ref_keluarga,
            COUNT(a.kd_anggota) AS total_anggota_keluarga
        FROM 
            tbl_keluarga k
        LEFT JOIN 
            tbl_anggota_keluarga a ON k.kd_keluarga = a.kd_keluarga
        WHERE
            k.kd_sektor = $kdsektor
        GROUP BY 
            k.kd_keluarga, k.nama_keluarga, k.kd_ref_keluarga;
        ";
        $res = mysqli_query($this->conn, $qry);

        $result = [];
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $result[] = $row;
            }
        }

        return $result;

    }

    public function getDetailKeluarga($id)
    {   
        $dataKel = [];
        $id = mysqli_real_escape_string($this->conn, $id);
        $qryGet = "SELECT klg.kd_keluarga, klg.kd_ref_keluarga, klg.nama_keluarga, klg.alamat_keluarga FROM tbl_keluarga klg WHERE klg.kd_keluarga = '$id'";
        $resultKeluarga = mysqli_query($this->conn, $qryGet);

        $qryGetAnggota = "SELECT agt.nama_anggota, agt.jenis_kelamin, agt.status_hubungan, agt.kd_anggota FROM tbl_anggota_keluarga agt WHERE agt.kd_keluarga = '$id'";
        $resultAnggota = mysqli_query($this->conn, $qryGetAnggota);


        if ($resultKeluarga && $resultAnggota) {
            $dataKel['keluarga'] = mysqli_fetch_assoc($resultKeluarga);
            $dataKel['anggota'] = mysqli_fetch_all($resultAnggota);
            if ($dataKel) {
                return $dataKel;
            } else {
                return ['content' => 'No data found'];
            }
        } else {
            return ['content' => 'Error executing query'];
        }
    }
}