package model;

public class Anggota {
    private String idAnggota;
    private String nama;
    private String alamat;
    
    public Anggota(String idAnggota, String nama, String alamat){
        this.idAnggota = idAnggota;
        this.nama = nama;
        this.alamat = alamat;
    }
    
    public String getIdAnggota(){
        return idAnggota;
    }
    
    public String getNama(){
        return nama;
    }
    
    public void setNama(String nama){
        this.nama = nama;
    }
    
    public String getAlamat(){
        return alamat;
    }
    
    public void setAlamat(String alamat){
        this.alamat = alamat;
    }
}
