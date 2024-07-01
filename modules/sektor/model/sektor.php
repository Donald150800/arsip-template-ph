<?php

class Sektor
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function insertSektor($data)
    {
        if (!isset($data['inisial_sektor']) || !isset($data['nama_sektor']) || !isset($data['deskripsi_sektor'])) {
            return ['status' => 'error', 'message' => 'Data tidak lengkap'];
        }

        $sql = "SELECT COUNT(*) as total FROM tbl_sektor";
        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $total = $row["total"];

            if ($total < 5) {
                // Sanitasi dan persiapkan data
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
                return ['status' => 'error', 'message' => 'Sektor sudah melebihi batas input'];
            }
        } else {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan saat menghitung data'];
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
        $qry = "SELECT * FROM tbl_sektor";
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
