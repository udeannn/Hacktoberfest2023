package service;

import model.Anggota;
import model.Buku;
import model.Transaksi;

import java.util.ArrayList;
import java.util.List;

public class Perpustakaan {
    private List<Buku> daftarBuku;
    private List<Anggota> daftarAnggota;
    private List<Transaksi> daftarTransaksi;
    
    public Perpustakaan(){
        daftarBuku = new ArrayList<>();
        daftarAnggota = new ArrayList<>();
        daftarTransaksi = new ArrayList<>();
    }
    
    public void tambahBuku(Buku buku){
        daftarBuku.add(buku);
    }
    
    public void tambahAnggota(Anggota anggota){
        daftarAnggota.add(anggota);
    }
    
    public Transaksi pinjamBuku(Anggota anggota, Buku buku){
        String idTransaksi = generateUniqueTransactionId();
        Transaksi transaksi = new Transaksi(idTransaksi, anggota, buku);
        if (buku.getStok() > 0){
            buku.kurangStok(1);
            daftarTransaksi.add(transaksi);
        } else{
            System.out.println("Buku tidak tersedia saat ini!!");
        }
        return transaksi;
    }
    
    public void kembalikanBuku(Transaksi transaksi){
        transaksi.setTanggalKembali(new java.util.Date());
        transaksi.getBuku().tambahStok(1);
    }
    
    public List<Buku> getDaftarBuku(){
        return daftarBuku;
    }
    
    public List<Anggota> getDaftarAnggota(){
        return daftarAnggota;
    }
    
    public List<Transaksi> getDaftarTransaksi(){
        return daftarTransaksi;
    }
    
    private String generateUniqueTransactionId(){
        long timestamp = System.currentTimeMillis();
        return "TX" + timestamp;
    }
    
}
