
    async function fetchData() {
        try {
            const response = await fetch('https://www.riizeadev.tech/fetch.php');
            const data = await response.json();

            // Ambil data yang dibutuhkan
            const { data: dataList } = data;
            const resultContainer = document.getElementById('data-container');

            // Loop melalui setiap objek dalam dataList
            dataList.forEach(item => {
                const { nama_member, live_count, viewer_count, start_live } = item;

                // Buat baris tabel untuk menampilkan data
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${nama_member}</td>
                    <td>${live_count}</td>
                    <td>${start_live}</td>
                    <td>${viewer_count}</td>
                `;

                // Tambahkan baris ke dalam tabel
                resultContainer.appendChild(row);
            });
        } catch (error) {
            console.error('Terjadi kesalahan:', error);
        }
    }

    // Panggil fungsi fetchData saat halaman dimuat
    window.addEventListener('load', fetchData);