package ui;

import model.Buku;
import model.Anggota;
import model.Transaksi;
import service.Perpustakaan;

import java.util.Date;
import java.util.List;
import java.util.Scanner;

public class MainLibraryApp {
    private Perpustakaan perpustakaan;
    private Scanner scanner;
    
    public MainLibraryApp(){
        perpustakaan = new Perpustakaan();
        scanner = new Scanner(System.in);
    }
    
    public void run(){
        System.out.println("Selamat datang di System Perpustakaan :)");
        
        while (true){
            System.out.println("\nMenu: ");
            System.out.println("1. Tambah Buku");
            System.out.println("2. Tambah Anggota");
            System.out.println("3. Pinjam Buku");
            System.out.println("4. Pengembalian Buku");
            System.out.println("5. List Buku");
            System.out.println("6. List Anggota");
            System.out.println("7. List Transaksi Peminjaman");
            System.out.println("8. Tambah Stok Buku");
            System.out.println("9. Keluar");
            System.out.print("Pilih Menu (1-9): ");
            
            int pilihan = scanner.nextInt();
            scanner.nextLine(); // Membuang newline

            switch (pilihan) {
                case 1:
                    System.out.println("Tambah Buku");
                    System.out.print("Masukkan kode buku: ");
                    String kodeBuku = scanner.nextLine();
                    System.out.print("Masukkan judul buku: ");
                    String judulBuku = scanner.nextLine();
                    System.out.print("Masukkan nama pengarang: ");
                    String pengarangBuku = scanner.nextLine();
                    System.out.print("Masukkan tahun terbit: ");
                    int tahunTerbit = scanner.nextInt();
                    scanner.nextLine(); // Membuang newline

                    Buku bukuBaru = new Buku(kodeBuku, judulBuku, pengarangBuku, tahunTerbit);
                    perpustakaan.tambahBuku(bukuBaru);
                    System.out.println("Buku berhasil ditambahkan.");
                    break;

                case 2:
                    System.out.println("Tambah Anggota");
                    System.out.print("Masukkan ID anggota: ");
                    String idAnggota = scanner.nextLine();
                    System.out.print("Masukkan nama anggota: ");
                    String namaAnggota = scanner.nextLine();
                    System.out.print("Masukkan alamat anggota: ");
                    String alamatAnggota = scanner.nextLine();

                    Anggota anggotaBaru = new Anggota(idAnggota, namaAnggota, alamatAnggota);
                    perpustakaan.tambahAnggota(anggotaBaru);
                    System.out.println("Anggota berhasil ditambahkan.");
                    break;

                case 3:
                    System.out.println("Pinjam Buku");
                    System.out.print("Masukkan ID anggota: ");
                    String idPeminjam = scanner.nextLine();
                    System.out.print("Masukkan kode buku yang ingin dipinjam: ");
                    String kodePinjam = scanner.nextLine();

                    Anggota peminjam = findAnggotaById(idPeminjam);
                    Buku bukuDipinjam = findBukuByKode(kodePinjam);

                    if (peminjam != null && bukuDipinjam != null) {
                        Transaksi transaksiPinjam = perpustakaan.pinjamBuku(peminjam, bukuDipinjam);
                        System.out.println("Buku berhasil dipinjam dengan ID Transaksi: " + transaksiPinjam.getIdTransaksi());
                    } else {
                        System.out.println("Anggota atau buku tidak ditemukan.");
                    }
                    break;

                case 4:
                    System.out.println("Kembalikan Buku");
                    System.out.print("Masukkan ID transaksi peminjaman: ");
                    String idTransaksiKembali = scanner.nextLine();

                    Transaksi transaksiKembali = findTransaksiById(idTransaksiKembali);
                    if (transaksiKembali != null) {
                        transaksiKembali.setTanggalKembali(new Date());
                        perpustakaan.kembalikanBuku(transaksiKembali);
                        System.out.println("Buku berhasil dikembalikan.");
                    } else {
                        System.out.println("Transaksi tidak ditemukan.");
                    }
                    break;

                case 5:
                    System.out.println("Daftar Buku:");
                    List<Buku> daftarBuku = perpustakaan.getDaftarBuku();
                    for (Buku buku : daftarBuku) {
                        System.out.println("Kode Buku: " + buku.getKodeBuku());
                        System.out.println("Judul: " + buku.getJudul());
                        System.out.println("Pengarang: " + buku.getPengarang());
                        System.out.println("Tahun Terbit: " + buku.getTahunTerbit());
                        System.out.println("Stok: " + buku.getStok());
                        System.out.println("---------------");
                    }
                    break;

                case 6:
                    System.out.println("Daftar Anggota:");
                    List<Anggota> daftarAnggota = perpustakaan.getDaftarAnggota();
                    for (Anggota anggota : daftarAnggota) {
                        System.out.println("ID Anggota: " + anggota.getIdAnggota());
                        System.out.println("Nama: " + anggota.getNama());
                        System.out.println("Alamat: " + anggota.getAlamat());
                        System.out.println("---------------");
                    }
                    break;

                case 7:
                    System.out.println("Daftar Transaksi Peminjaman:");
                    List<Transaksi> daftarTransaksi = perpustakaan.getDaftarTransaksi();
                    for (Transaksi transaksi : daftarTransaksi) {
                        System.out.println("ID Transaksi: " + transaksi.getIdTransaksi());
                        System.out.println("ID Anggota: " + transaksi.getAnggota().getIdAnggota());
                        System.out.println("Nama Anggota: " + transaksi.getAnggota().getNama());
                        System.out.println("Kode Buku: " + transaksi.getBuku().getKodeBuku());
                        System.out.println("Judul Buku: " + transaksi.getBuku().getJudul());
                        System.out.println("Tanggal Pinjam: " + transaksi.getTanggalPinjam());
                        System.out.println("Tanggal Kembali: " + transaksi.getTanggalKembali());
                        System.out.println("---------------");
                    }
                    break;

                case 8:
                    System.out.println("Tambah Stok Buku");
                    System.out.print("Masukkan Kode Buku: ");
                    String kodeBukuStok = scanner.nextLine();
                    System.out.print("Masukkan Jumlah Stok: ");
                    int jumlahStok = scanner.nextInt();
                    scanner.nextLine(); // membuang newline
                    
                    Buku bukuStok = findBukuByKode(kodeBukuStok);
                    if (bukuStok != null){
                        bukuStok.tambahStok(jumlahStok); //nambah stok
                        System.out.println("Stok buku berhasil diperbarui.");
                    } else{
                        System.out.println("Buku tidak ditemukan!.");
                    }
                    break;
                    
                case 9:
                    System.out.println("Terima kasih.");
                    return;
                
                default:
                    System.out.println("Pilihan tidak valid. Silakan pilih lagi.");
            }
        }
    }

    private Anggota findAnggotaById(String idAnggota) {
        List<Anggota> daftarAnggota = perpustakaan.getDaftarAnggota();
        for (Anggota anggota : daftarAnggota) {
            if (anggota.getIdAnggota().equals(idAnggota)) {
                return anggota;
            }
        }
        return null;
    }

    private Buku findBukuByKode(String kodeBuku) {
        List<Buku> daftarBuku = perpustakaan.getDaftarBuku();
        for (Buku buku : daftarBuku) {
            if (buku.getKodeBuku().equals(kodeBuku)) {
                return buku;
            }
        }
        return null;
    }

    private Transaksi findTransaksiById(String idTransaksi) {
        List<Transaksi> daftarTransaksi = perpustakaan.getDaftarTransaksi();
        for (Transaksi transaksi : daftarTransaksi) {
            if (transaksi.getIdTransaksi().equals(idTransaksi)) {
                return transaksi;
            }
        }
        return null;
    }
    

    public static void main(String[] args) {
        MainLibraryApp app = new MainLibraryApp();
        app.run();
    }
    
}
