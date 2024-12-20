document.getElementById('createApiBtn').addEventListener('click', async () => {
  const apiData = document.getElementById('apiData').value;

  if (!apiData) {
    alert('Vui lòng nhập dữ liệu JSON!');
    return;
  }

  try {
    // Kiểm tra JSON hợp lệ
    JSON.parse(apiData);

    // Gửi dữ liệu đến file PHP
    const response = await fetch('create_api.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ json: apiData }),
    });

    const result = await response.json();

    if (result.success) {
      // Hiển thị URL API
      document.getElementById('result').classList.remove('hidden');
      document.getElementById('apiLink').href = result.api_url;
      document.getElementById('apiLink').textContent = result.api_url;
    } else {
      alert('Lỗi: ' + result.error);
    }
  } catch (err) {
    alert('Dữ liệu JSON không hợp lệ!');
  }
});
