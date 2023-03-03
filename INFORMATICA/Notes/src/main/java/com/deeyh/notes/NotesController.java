package com.deeyh.notes;

import java.io.File;
import java.io.FileWriter;
import java.io.IOException;

import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.control.TextArea;
import javafx.scene.layout.BorderPane;
import javafx.stage.FileChooser;
import javafx.stage.Stage;



public class NotesController {

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
        String selectedText = textArea.getSelectedText();

        if(selectedText != null && !selectedText.isEmpty()) {

            int startIndex = textArea.getSelection().getStart();
            int endIndex = textArea.getSelection().getEnd();
            String newText = "<b>" + selectedText + "</b>";
            textArea.replaceText(startIndex, endIndex, newText);

        }
    }

    public void underLine() {
        String selectedText = textArea.getSelectedText();

        if(selectedText != null && !selectedText.isEmpty()) {

            int startIndex = textArea.getSelection().getStart();
            int endIndex = textArea.getSelection().getEnd();
            String newText = "<u>" + selectedText + "</u>";
            textArea.replaceText(startIndex, endIndex, newText);

        }
    }

    public void script() {
        String selectedText = textArea.getSelectedText();

        if(selectedText != null && !selectedText.isEmpty()) {

            int startIndex = textArea.getSelection().getStart();
            int endIndex = textArea.getSelection().getEnd();
            String newText = "<i>" + selectedText + "</i>";
            textArea.replaceText(startIndex, endIndex, newText);

        }
    }


}
