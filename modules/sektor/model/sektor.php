<?php

class Sektor
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function insertSektor($post){
        parse_str($post, $data);
        if (!isset($data['inisial_sektor']) || !isset($data['nama_sektor']) || !isset($data['deskripsi_sektor'])) {
            return ['status' => 'error', 'message' => 'Data tidak lengkap'];
        }

        if ($data['act'] == 'do_add') {
            $sql = "SELECT COUNT(*) as total FROM tbl_sektor";
            $result = mysqli_query($this->conn, $sql);

            if ($result) {
                $inisial_sektor = mysqli_real_escape_string($this->conn, $data['inisial_sektor']);
                $nama_sektor = mysqli_real_escape_string($this->conn, $data['nama_sektor']);
                $deskripsi_sektor = mysqli_real_escape_string($this->conn, $data['deskripsi_sektor']);
                $created_date = date('Y-m-d H:i:s');
                
                $qry = "INSERT INTO tbl_sektor (kd_sektor, inisial_sektor, nama_sektor, deskripsi, created_at) VALUES ('', '$inisial_sektor', '$nama_sektor', '$deskripsi_sektor', '$created_date')";
                $ret = mysqli_query($this->conn, $qry);
                
                if ($ret) {
                    return ['status' => 'success', 'message' => 'Sektor ' . $nama_sektor . ' berhasil ditambahkan'];
                } else {
                    return ['status' => 'error', 'message' => 'Terjadi kesalahan saat menambahkan data'];
                }
            } else {
                return ['status' => 'error', 'message' => 'Terjadi kesalahan saat menghitung data'];
            }
        } else if ($data['act'] == 'do_update') {
            if (!isset($data['kd_sektor'])) {
                return ['status' => 'error', 'message' => 'ID Sektor tidak tersedia'];
            }

            $kd_sektor = mysqli_real_escape_string($this->conn, $data['kd_sektor']);
            $inisial_sektor = mysqli_real_escape_string($this->conn, $data['inisial_sektor']);
            $nama_sektor = mysqli_real_escape_string($this->conn, $data['nama_sektor']);
            $deskripsi_sektor = mysqli_real_escape_string($this->conn, $data['deskripsi_sektor']);

            $qry = "UPDATE tbl_sektor SET 
                    inisial_sektor = '$inisial_sektor', 
                    nama_sektor = '$nama_sektor', 
                    deskripsi = '$deskripsi_sektor',
                    updated_at = NOW()
                    WHERE kd_sektor = '$kd_sektor'";

            $ret = mysqli_query($this->conn, $qry);

            if ($ret) {
                return ['status' => 'success', 'message' => 'Sektor ' . $nama_sektor . ' berhasil diperbarui'];
            } else {
                return ['status' => 'error', 'message' => 'Terjadi kesalahan saat memperbarui data'];
            }
        } else {
            return ['status' => 'error', 'message' => 'Operasi tidak valid'];
        }
    }


    public function getDetailSektor($id)
    {
        $id = mysqli_real_escape_string($this->conn, $id);
        $qryGet = "SELECT * FROM tbl_sektor WHERE kd_sektor = '$id'";
        $result = mysqli_query($this->conn, $qryGet);

        if ($result) {
            $data = mysqli_fetch_assoc($result);
            if ($data) {
                return $data;
            } else {
                return ['content' => 'No data found'];
            }
        } else {
            return ['content' => 'Error executing query'];
        }
    }

    public function deleteSektor($id)
    {
        $id = mysqli_real_escape_string($this->conn, $id);
        $qryDelete = "DELETE FROM tbl_sektor WHERE kd_sektor = '$id'";
        
        if (mysqli_query($this->conn, $qryDelete)) {
            return ['status' => 'success', 'message' => 'Data berhasil dihapus'];
        } else {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan saat menghapus data'];
        }
    }

    public function getAllSektor()
    {
        $qry = "SELECT * FROM tbl_sektor ORDER BY kd_sektor DESC";
        $res = mysqli_query($this->conn, $qry);

        $data = [];
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $data[] = $row;
            }
        }

        return $data;
    }

    public function getSektorPage(){
        $qry = "SELECT 
                sektor.inisial_sektor, 
                sektor.kd_sektor, 
                sektor.nama_sektor, 
                COUNT(DISTINCT keluarga.kd_keluarga) AS total_keluarga,
                COUNT(anggota.kd_anggota) AS total_anggota_keluarga
                FROM 
                    tbl_sektor sektor
                LEFT JOIN 
                    tbl_keluarga keluarga ON sektor.kd_sektor = keluarga.kd_sektor
                LEFT JOIN 
                    tbl_anggota_keluarga anggota ON keluarga.kd_keluarga = anggota.kd_keluarga
                GROUP BY 
                    sektor.kd_sektor, sektor.nama_sektor
                ";

                $res = mysqli_query($this->conn, $qry);

                $data = [];
                if ($res) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $data[] = $row;
                    }
                }
            
                return $data;
    }
}
?>
