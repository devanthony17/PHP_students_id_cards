<?php

function create_id_card($student_name, $student_id, $school_name, $output_path) {
    // Dimensions of the ID card
    $width = 400;
    $height = 250;
    $background_color = [255, 255, 255]; // white
    $text_color = [0, 0, 0]; // black

    // Create a blank image with white background
    $image = imagecreatetruecolor($width, $height);
    $bg_color = imagecolorallocate($image, $background_color[0], $background_color[1], $background_color[2]);
    imagefill($image, 0, 0, $bg_color);

    // Set text color
    $txt_color = imagecolorallocate($image, $text_color[0], $text_color[1], $text_color[2]);

    // Define font path and font size
    $font_path = __DIR__ . '/arial.ttf'; // Make sure this path is correct
    $font_size = 20;

    // Define positions for the text
    $school_name_position = [20, 40];
    $student_name_position = [20, 120];
    $student_id_position = [20, 180];
    $logo_position = [300, 20];
    
    // Add text to the image
    imagettftext($image, $font_size, 0, $school_name_position[0], $school_name_position[1], $txt_color, $font_path, $school_name);
    imagettftext($image, $font_size, 0, $student_name_position[0], $student_name_position[1], $txt_color, $font_path, "Name: " . $student_name);
    imagettftext($image, $font_size, 0, $student_id_position[0], $student_id_position[1], $txt_color, $font_path, "ID: " . $student_id);

    // Draw a rectangle for the logo (placeholder)
    $logo_rect_color = imagecolorallocate($image, $text_color[0], $text_color[1], $text_color[2]);
    imagerectangle($image, $logo_position[0], $logo_position[1], $logo_position[0] + 80, $logo_position[1] + 80, $logo_rect_color);
    imagettftext($image, $font_size, 0, $logo_position[0] + 15, $logo_position[1] + 50, $txt_color, $font_path, "Logo");

    // Save the image
    imagepng($image, $output_path);
    imagedestroy($image);
    echo "ID card created for $student_name and saved to $output_path\n";
}

// Example usage
$students = [
    ["name" => "John Doe", "id" => "123456", "school" => "XYZ High School"],
    ["name" => "Jane Smith", "id" => "789012", "school" => "XYZ High School"]
];

foreach ($students as $student) {
    $output_file = "id_card_" . $student['id'] . ".png";
    create_id_card($student['name'], $student['id'], $student['school'], $output_file);
}

?>
