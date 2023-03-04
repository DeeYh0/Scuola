package com.deeyh.notes;

import java.io.File;
import java.io.FileWriter;
import java.io.IOException;

import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.control.TextArea;
import javafx.scene.image.Image;
import javafx.scene.layout.BorderPane;
import javafx.scene.text.Font;
import javafx.scene.text.FontWeight;
import javafx.stage.FileChooser;
import javafx.stage.Stage;



public class NotesController {

    private Font font = Font.loadFont(NotesApplication.class.getResource("microsoft.ttf").toExternalForm(), 20);
    private boolean isBold = false;
    private boolean isItalic = false;

    private boolean isDefault = false;
    @FXML
    private TextArea textArea;

    @FXML
    public void save() {
        FileChooser fileChooser = new FileChooser();

        FileChooser.ExtensionFilter extFilter = new FileChooser.ExtensionFilter("File di testo (*.txt)", "*.txt");
        fileChooser.getExtensionFilters().add(extFilter);
        File file = fileChooser.showSaveDialog(null);

        if (file != null) {
            try {
                FileWriter fileWriter = new FileWriter(file);
                fileWriter.write(textArea.getText());
                fileWriter.close();
            } catch (IOException e) {
                e.printStackTrace();
            }
        }
    }

    public void newWindow() {
        try {
            FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("Notes-view.fxml"));
            BorderPane root = (BorderPane) fxmlLoader.load();
            Scene scene = new Scene(root, 1000, 550);

            Stage stage = new Stage();
            stage.setTitle("Notes");
            Image image = new Image(NotesApplication.class.getResource("icon.png").openStream());
            stage.getIcons().add(image);
            stage.setResizable(false);
            stage.setScene(scene);
            stage.show();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public void close() {
        System.exit(0);
    }

    public void gitHelp() {
        try {
            String url = "https://github.com/DeeYh0";
            java.awt.Desktop.getDesktop().browse(java.net.URI.create(url));
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public void bold() {
        if (!isBold) {
            textArea.setStyle(textArea.getStyle() + "-fx-font-weight: bold;");
            isBold = true;
        } else if (isBold) {
            textArea.setStyle(textArea.getStyle() + "-fx-font-weight: normal;");
            isBold = false;
        }
    }

    public void italic() {
        if (!isItalic) {
            textArea.setStyle(textArea.getStyle() + "-fx-font-style: italic;");
            isItalic = true;
        } else if (isItalic) {
            textArea.setStyle(textArea.getStyle() + "-fx-font-style: normal;");
            isItalic = false;
        }
    }

    public void comic() {
        if (!isDefault) {
            textArea.setFont(Font.font("Comic Sans MS", 20));
            isDefault = true;
        } else if (isDefault) {
            textArea.setFont(Font.font("Calibri", 20));
            isDefault = false;
        }

    }

    public void microsoft() {
        if (!isDefault) {
            textArea.setFont(font);
            isDefault = true;
        } else if (isDefault) {
            textArea.setFont(Font.font("Calibri", 20));
            isDefault = false;
        }
    }

    public void gothic() {
        if (!isDefault) {
            textArea.setFont(Font.font("MS Gothic", 20));
            isDefault = true;
        } else if (isDefault) {
            textArea.setFont(Font.font("Calibri", 20));
            isDefault = false;
        }
    }
}
