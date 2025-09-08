<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Football Fan Card Generator</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <style>
        :root {
            --primary: #1a3263;
            --secondary: #f16821;
            --accent: #1e90ff;
            --light: #f8f9fa;
            --dark: #212529;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #0c2461, #1e3799);
            color: var(--light);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            backdrop-filter: blur(10px);
        }

        .logo {
            font-size: 2.5rem;
            font-weight: bold;
            color: white;
            margin-bottom: 10px;
        }

        .logo span {
            color: var(--secondary);
        }

        .subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .content {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
        }

        .form-section, .card-section {
            flex: 1;
            min-width: 300px;
            background: rgba(255, 255, 255, 0.1);
            padding: 25px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        }

        .section-title {
            font-size: 1.5rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--secondary);
            color: white;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        input, select {
            width: 100%;
            padding: 12px 15px;
            border: none;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
        }

        button {
            width: 100%;
            padding: 14px;
            background: var(--secondary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background: #e55a1a;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .fan-card {
            background: linear-gradient(135deg, var(--primary), #2c3e50);
            border-radius: 15px;
            padding: 25px;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            margin-bottom: 25px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .club-logo {
            font-size: 2rem;
            font-weight: bold;
        }

        .fan-id {
            font-size: 0.9rem;
            background: rgba(255, 255, 255, 0.2);
            padding: 5px 10px;
            border-radius: 20px;
        }

        .fan-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: #ccc;
            margin: 0 auto 20px;
            overflow: hidden;
            border: 4px solid white;
        }

        .fan-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .fan-name {
            text-align: center;
            font-size: 1.5rem;
            margin-bottom: 5px;
        }

        .fan-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin: 20px 0;
        }

        .detail-item {
            background: rgba(255, 255, 255, 0.1);
            padding: 10px;
            border-radius: 8px;
            text-align: center;
        }

        .detail-label {
            font-size: 0.8rem;
            opacity: 0.8;
        }

        .detail-value {
            font-weight: 500;
            margin-top: 5px;
        }

        .qr-code {
            text-align: center;
            margin-top: 20px;
            padding: 15px;
            background: white;
            border-radius: 10px;
            display: inline-block;
        }

        .card-footer {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .instructions {
            margin-top: 30px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            backdrop-filter: blur(10px);
        }

        .instructions h3 {
            margin-bottom: 15px;
            color: var(--secondary);
        }

        .instructions ol {
            padding-left: 20px;
        }

        .instructions li {
            margin-bottom: 10px;
            line-height: 1.5;
        }

        @media (max-width: 768px) {
            .content {
                flex-direction: column;
            }

            .form-section, .card-section {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">FC <span>CHAMPIONS</span></div>
            <div class="subtitle">Official Fan Card Generator</div>
        </header>

        <div class="content">
            <div class="form-section">
                <h2 class="section-title">Create Your Fan Profile</h2>
                <form id="fanForm">
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" id="fullName" placeholder="Enter your full name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" placeholder="Enter your email" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" placeholder="Enter your phone number">
                    </div>

                    <div class="form-group">
                        <label for="membership">Membership Type</label>
                        <select id="membership" required>
                            <option value="">Select membership</option>
                            <option value="standard">Standard Fan</option>
                            <option value="premium">Premium Fan</option>
                            <option value="vip">VIP Fan</option>
                            <option value="lifetime">Lifetime Member</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="since">Fan Since</label>
                        <input type="number" id="since" min="1900" max="2023" placeholder="Year you became a fan" required>
                    </div>

                    <button type="submit">Generate Fan Card & QR Code</button>
                </form>
            </div>

            <div class="card-section">
                <h2 class="section-title">Your Virtual Fan Card</h2>
                <div class="fan-card">
                    <div class="card-header">
                        <div class="club-logo">FC CHAMPIONS</div>
                        <div class="fan-id">ID: <span id="displayId">FC-0000</span></div>
                    </div>

                    <div class="fan-photo">
                        <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyMDAgMjAwIiBmaWxsPSIjNzg4MTk2Ij48cmVjdCB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI2NjYyIvPjx0ZXh0IHg9IjEwMCIgeT0iMTAwIiBmb250LWZhbWlseT0iQXJpYWwsIHNhbnMtc2VyaWYiIGZvbnQtc2l6ZT0iNjAiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGRvbWluYW50LWJhc2VsaW5lPSJtaWRkbGUiIGZpbGw9IiM3ODgxOTYiPlBIPC90ZXh0Pjwvc3ZnPg==" alt="Fan Photo" id="fanPhoto">
                    </div>

                    <h3 class="fan-name" id="displayName">Fan Name</h3>

                    <div class="fan-details">
                        <div class="detail-item">
                            <div class="detail-label">MEMBERSHIP</div>
                            <div class="detail-value" id="displayMembership">Standard</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">MEMBER SINCE</div>
                            <div class="detail-value" id="displaySince">2023</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">EMAIL</div>
                            <div class="detail-value" id="displayEmail">fan@example.com</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">PHONE</div>
                            <div class="detail-value" id="displayPhone">+1234567890</div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div id="qrcode"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="instructions">
            <h3>How to Use Your Virtual Fan Card</h3>
            <ol>
                <li>Fill out the form with your details and click "Generate Fan Card & QR Code"</li>
                <li>Your virtual fan card will be generated with a unique QR code</li>
                <li>Show your QR code at the stadium for quick entry and access to fan zones</li>
                <li>Use your fan card to get discounts at official merchandise stores</li>
                <li>Present your card to participate in exclusive club events and meetups</li>
            </ol>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fanForm = document.getElementById('fanForm');
            const qrcodeDiv = document.getElementById('qrcode');
            let qrcode = null;

            // Generate random fan ID
            function generateFanId() {
                return 'FC-' + Math.floor(1000 + Math.random() * 9000);
            }

            // Update fan card with form data
            function updateFanCard(formData) {
                document.getElementById('displayId').textContent = generateFanId();
                document.getElementById('displayName').textContent = formData.fullName;
                document.getElementById('displayEmail').textContent = formData.email;
                document.getElementById('displayPhone').textContent = formData.phone || 'Not provided';
                document.getElementById('displayMembership').textContent =
                    document.getElementById('membership').options[document.getElementById('membership').selectedIndex].text;
                document.getElementById('displaySince').textContent = formData.since;

                // Generate QR code
                if (qrcode) {
                    qrcodeDiv.innerHTML = '';
                }

                qrcode = new QRCode(qrcodeDiv, {
                    text: JSON.stringify({
                        id: document.getElementById('displayId').textContent,
                        name: formData.fullName,
                        email: formData.email,
                        since: formData.since
                    }),
                    width: 120,
                    height: 120,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });
            }

            // Handle form submission
            fanForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = {
                    fullName: document.getElementById('fullName').value,
                    email: document.getElementById('email').value,
                    phone: document.getElementById('phone').value,
                    membership: document.getElementById('membership').value,
                    since: document.getElementById('since').value
                };

                updateFanCard(formData);
            });

            // Initialize with sample data
            const sampleData = {
                fullName: 'John Doe',
                email: 'john.doe@example.com',
                phone: '+1234567890',
                membership: 'standard',
                since: '2015'
            };

            // Set sample values in form
            document.getElementById('fullName').value = sampleData.fullName;
            document.getElementById('email').value = sampleData.email;
            document.getElementById('phone').value = sampleData.phone;
            document.getElementById('membership').value = sampleData.membership;
            document.getElementById('since').value = sampleData.since;

            // Generate initial card
            updateFanCard(sampleData);
        });
    </script>
</body>
</html>
