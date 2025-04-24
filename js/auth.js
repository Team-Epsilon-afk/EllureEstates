window.onload = function () {
    google.accounts.id.initialize({
        client_id: "YOUR_GOOGLE_CLIENT_ID",
        callback: handleCredentialResponse
    });

    google.accounts.id.renderButton(
        document.getElementById("googleSignInDiv"), // A div where the button will appear
        { theme: "outline", size: "large" }
    );

    google.accounts.id.prompt(); // Auto sign-in prompt
};

function handleCredentialResponse(response) {
    // Send the token to the backend for verification
    fetch('/verify-google-login.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ credential: response.credential })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            // User is logged in, now update the UI
            document.getElementById('loginBtn').style.display = 'none';
            document.getElementById('userEmail').textContent = data.email;
            document.getElementById('userInfo').style.display = 'block';
        }
    })
    .catch(err => console.error('Login failed:', err));
}
