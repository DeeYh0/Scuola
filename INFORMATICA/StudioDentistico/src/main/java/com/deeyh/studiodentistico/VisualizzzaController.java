package com.deeyh.studiodentistico;

import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.MenuBar;
import javafx.scene.control.TextArea;
import javafx.stage.Stage;

import java.io.BufferedReader;
import java.io.File;
import java.io.FileReader;
import java.io.IOException;
import java.nio.file.Files;
import java.util.List;

public class VisualizzzaController {

    @FXML
    private Parent root;

    private Stage PazientiStage;
    private Scene PazientiScene;

    @FXML
    private MenuBar menubar;

    @FXML
    private TextArea printPatient;

    @FXML
    private void initialize() throws IOException {
        viewPatient();
    }

    public void registra(ActionEvent ev) throws IOException {
        try {
            root = FXMLLoader.load(getClass().getResource("Registra.fxml"));
            PazientiStage = (Stage) menubar.getScene().getWindow();
            PazientiStage.setTitle("Registra Pazienti");
            PazientiScene = new Scene(root);
            PazientiStage.setScene(PazientiScene);
            PazientiStage.show();
            PazientiStage.setResizable(false);

        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public void visualizza() throws IOException {
        try {
            root = FXMLLoader.load(getClass().getResource("Visualizza.fxml"));
            PazientiStage = (Stage) menubar.getScene().getWindow();
            PazientiStage.setTitle("Visualizza Pazienti");
            PazientiScene = new Scene(root);
            PazientiStage.setScene(PazientiScene);
            PazientiStage.show();
            PazientiStage.setResizable(false);

        } catch (IOException e) {
            e.printStackTrace();
        }
        viewPatient();
    }

    public void gestione() throws IOException {
        try {
            root = FXMLLoader.load(getClass().getResource("Gestione.fxml"));
            PazientiStage = (Stage) menubar.getScene().getWindow();
            PazientiStage.setTitle("Gestione Pazienti");
            PazientiScene = new Scene(root);
            PazientiStage.setScene(PazientiScene);
            PazientiStage.show();
            PazientiStage.setResizable(false);

        } catch (IOException e) {
            e.printStackTrace();
        }
    }


    public void viewPatient() throws IOException {
        BufferedReader reader = new BufferedReader(new FileReader("FILE_PAZIENTI.txt"));
        StringBuilder stringBuilder = new StringBuilder();
        String line = reader.readLine();
        if (line == null) {
            System.out.println("NON CI SONO PAZIENTI");
        } else {
            while (line != null) {
                stringBuilder.append(line).append("\n");
                line = reader.readLine();

            }
        }
        reader.close();
        printPatient.setText(stringBuilder.toString());
    }

    public void close() {
        System.exit(0);
    }

    public void about() {
        try {
            root = FXMLLoader.load(getClass().getResource("About.fxml"));
            PazientiStage = (Stage) menubar.getScene().getWindow();
            PazientiStage.setTitle("About us");
            PazientiScene = new Scene(root);
            PazientiStage.setScene(PazientiScene);
            PazientiStage.show();
            PazientiStage.setResizable(false);

        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public void home() throws IOException {
        try {
            root = FXMLLoader.load(getClass().getResource("Studio-view.fxml"));
            PazientiStage = (Stage) menubar.getScene().getWindow();
            PazientiStage.setTitle("Studio Dentistico");
            PazientiScene = new Scene(root);
            PazientiStage.setScene(PazientiScene);
            PazientiStage.show();
            PazientiStage.setResizable(false);

        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    @FXML
    public void add() {
        try {
            root = FXMLLoader.load(getClass().getResource("Registra.fxml"));
            PazientiStage = (Stage) menubar.getScene().getWindow();
            PazientiStage.setTitle("Registra Pazienti");
            PazientiScene = new Scene(root);
            PazientiStage.setScene(PazientiScene);
            PazientiStage.show();
            PazientiStage.setResizable(false);

        } catch (IOException e) {
            e.printStackTrace();
        }
    }


    @FXML
    public void remove() throws IOException {
        try {
            File inputFile = new File("FILE_PAZIENTI.txt");
            List<String> lines = Files.readAllLines(inputFile.toPath());

            lines.subList(0, 7).clear();
            Files.write(inputFile.toPath(), lines);
        } catch (Exception e) {
            System.out.println("NON CI SONO PIU PAZIENTI IN LISTA");
        }
        viewPatient();
    }


}
