package model;

public class Buku {
    private String kodeBuku;
    private String judul;
    private String pengarang;
    private int tahunTerbit;
    private int stok;
    
    public Buku(String kodeBuku, String judul, String pengarang, int tahunTerbit){
        this.kodeBuku = kodeBuku;
        this.judul = judul;
        this.pengarang = pengarang;
        this.tahunTerbit = tahunTerbit;
        this.stok = 0;
    }
    
    public String getKodeBuku(){
        return kodeBuku;
    }
    
    public String getJudul(){
        return judul;
    }
    
    public String getPengarang(){
        return pengarang;
    }
    
    public int getTahunTerbit(){
        return tahunTerbit;
    }
    
    public int getStok(){
        return stok;
    }
    
    public void tambahStok(int jumlah){
        stok += jumlah;
    }
    
    public void kurangStok(int jumlah){
        if (stok >= jumlah){
            stok -= jumlah;
        } else{
            System.out.println("Stok tidak mencukupi");
        }
    }
}
