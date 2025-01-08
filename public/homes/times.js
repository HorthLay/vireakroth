function startCountdown(durationInSeconds) {
    let remainingTime = durationInSeconds; // Time in seconds
    const countdownElement = document.getElementById("countdownTimer");

    const interval = setInterval(() => {
        if (remainingTime <= 0) {
            clearInterval(interval);
            countdownElement.textContent = "00:00";
            return;
        }

        const minutes = Math.floor(remainingTime / 60);
        const seconds = remainingTime % 60;

        // Update the countdown timer
        countdownElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        remainingTime--;
    }, 1000);
}

// Start a 2-minute (120 seconds) countdown
startCountdown(120);
function startCountdown(durationInSeconds) {
    let remainingTime = durationInSeconds; // Time in seconds
    const countdownElement = document.getElementById("countdownTimer");

    const interval = setInterval(() => {
        if (remainingTime <= 0) {
            clearInterval(interval);
            countdownElement.textContent = "00:00";
            return;
        }

        const minutes = Math.floor(remainingTime / 60);
        const seconds = remainingTime % 60;

        // Update the countdown timer
        countdownElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        remainingTime--;
    }, 1000);
}

// Start a 2-minute (120 seconds) countdown
startCountdown(120);
