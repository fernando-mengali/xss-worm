<?php
// Get the POST data
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['image'])) {
    // Get the base64 encoded string
    $imgData = $data['image'];

    // Remove the data URL part (optional, depending on how you send the data)
    $imgData = str_replace('data:image/png;base64,', '', $imgData);
    $imgData = str_replace(' ', '+', $imgData);

    // Decode the base64 string
    $decodedData = base64_decode($imgData);

    // Set the file path and name
    $filePath = 'uploads/';
    $fileName = 'captured_image_' . time() . '.png';

    // Make sure the uploads directory exists
    if (!file_exists($filePath)) {
        mkdir($filePath, 0777, true);
    }

    // Save the file
    file_put_contents($filePath . $fileName, $decodedData);

    // Return a response
    echo 'Image uploaded successfully: ' . $fileName;
} else {
    echo 'No image data received';
}
?>
