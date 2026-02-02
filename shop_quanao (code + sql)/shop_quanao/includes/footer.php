</div> <footer class="mt-5" style="background-color: #fbe4e9; border-top: 5px solid #ff85a2; color: #4a4a4a;">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-md-4">
                <h4 style="font-family: 'Pacifico', cursive; color: #ef476f;">🌸 THE FASHION</h4>
                <p class="mt-3 small">
                    Chào mừng bạn đến với thiên đường thời trang kẹo ngọt! Chúng mình luôn cập nhật những mẫu thiết kế mới nhất để bạn luôn tỏa sáng và yêu đời mỗi ngày.
                </p>
                <div class="d-flex gap-3 mt-3">
                    <a href="#" class="text-decoration-none" style="color: #ff85a2;">f</a>
                    <a href="#" class="text-decoration-none" style="color: #ff85a2;">ig</a>
                    <a href="#" class="text-decoration-none" style="color: #ff85a2;">tt</a>
                </div>
            </div>

            <div class="col-md-4">
                <h5 class="fw-bold mb-3" style="color: #ef476f;">Thông Tin</h5>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="index.php" class="text-decoration-none text-muted">Trang chủ</a></li>
                    <li class="mb-2"><a href="index.php?tag=Hot" class="text-decoration-none text-muted">Sản phẩm nổi bật</a></li>
                    <li class="mb-2"><a href="my_orders.php" class="text-decoration-none text-muted">Theo dõi đơn hàng</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Chính sách đổi trả</a></li>
                </ul>
            </div>

            <div class="col-md-4">
                <h5 class="fw-bold mb-3" style="color: #ef476f;">Liên Hệ ✨</h5>
                <p class="small mb-2">📍 Vân Canh, Hoài Đức, Hà Nội</p>
                <p class="small mb-2">📞 Hotline: 0782 100 868</p>
                <p class="small mb-2">✉️ Email: tranhoa2005ls@gmail.com</p>
                <div class="mt-3 p-2 bg-white rounded-4 shadow-sm">
                    <span class="small fw-bold" style="color: #ff85a2;">Đăng ký nhận tin sale sớm nhất!</span>
                    <form id="subscribeForm" class="mt-2">
                        <div class="input-group">
                            <input type="email" id="subscribeEmail" class="form-control border-0 bg-light small" placeholder="Email của bạn..." required>
                            <button type="submit" class="btn btn-sm" style="background-color: #ff85a2; color: white;">Gửi</button>
                        </div>
                        <div id="subscribeMessage" class="mt-2 small"></div>
                    </form>
                </div>
            </div>
        </div>

        <hr class="my-4" style="background-color: #ff85a2; opacity: 0.2;">

        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="small mb-0">&copy; 2026 <strong>THE FASHION</strong>. Made with 💖 by Student Project</p>
            </div>
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" width="60" class="me-3 opacity-75">
                <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" width="40" class="me-3 opacity-75">
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" width="35" class="opacity-75">
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.getElementById('subscribeForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const email = document.getElementById('subscribeEmail').value;
    const messageDiv = document.getElementById('subscribeMessage');
    const submitBtn = this.querySelector('button[type="submit"]');
    
    submitBtn.disabled = true;
    submitBtn.textContent = 'Đang gửi...';
    messageDiv.textContent = '';
    
    const formData = new FormData();
    formData.append('email', email);
    
    fetch('subscribe.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        messageDiv.textContent = data.message;
        if (data.success) {
            messageDiv.style.color = '#28a745';
            document.getElementById('subscribeEmail').value = '';
            setTimeout(() => {
                messageDiv.textContent = '';
            }, 3000);
        } else {
            messageDiv.style.color = '#dc3545';
        }
    })
    .catch(error => {
        messageDiv.textContent = 'Có lỗi xảy ra!';
        messageDiv.style.color = '#dc3545';
    })
    .finally(() => {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Gửi';
    });
});
</script>
</body>
</html>