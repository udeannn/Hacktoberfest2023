package model;

import java.util.Date;

public class Transaksi {
    private String idTransaksi;
    private Anggota anggota;
    private Buku buku;
    private Date tanggalPinjam;
    private Date tanggalKembali;
    
    public Transaksi(String idTransaksi, Anggota anggota, Buku buku){
        this.idTransaksi = idTransaksi;
        this.anggota = anggota;
        this.buku = buku;
        this.tanggalPinjam = new Date();
        this.tanggalKembali = null;
    }
    
    public String getIdTransaksi(){
        return idTransaksi;
    }
    
    public Anggota getAnggota(){
        return anggota;
    }
    
    public Buku getBuku(){
        return buku;
    }
    
    public Date getTanggalPinjam(){
        return tanggalPinjam;
    }
    
    public Date getTanggalKembali(){
        return tanggalKembali;
    }
    
    public void setTanggalKembali(Date tanggalKembali){
        this.tanggalKembali = tanggalKembali;
    }
}
