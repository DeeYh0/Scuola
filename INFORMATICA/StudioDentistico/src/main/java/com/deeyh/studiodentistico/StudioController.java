package com.deeyh.studiodentistico;

import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.stage.Stage;
import java.io.IOException;

public class StudioController {
    public void close()
    {
        System.exit(0);
    }

    public void about() {
        try {
            FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("About.fxml"));
            Scene scene = new Scene(fxmlLoader.load(), 800, 600);

            Stage ab = new Stage();
            ab.setTitle("Studio Dentistico");
            ab.setScene(scene);
            ab.show();
            ab.setResizable(false);

        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public void home() throws IOException {
        FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("Studio-view.fxml"));
        Parent root1 = (Parent) fxmlLoader.load();
        Stage stage = new Stage();
        stage.setScene(new Scene(root1));
        stage.show();
    }

    public void registra() throws IOException {
        try {
            FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("Registra.fxml"));
            Scene scene = new Scene(fxmlLoader.load(), 800, 600);

            Stage reg = new Stage();
            reg.setTitle("Registra Pazienti");
            reg.setScene(scene);
            reg.show();
            reg.setResizable(false);

        } catch (IOException e) {
            e.printStackTrace();
        }
    }


    public void visualizza() throws IOException {
        try {
            FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("Visualizza.fxml"));
            Scene scene = new Scene(fxmlLoader.load(), 800, 600);

            Stage vis = new Stage();
            vis.setTitle("Visualizza Pazienti");
            vis.setScene(scene);
            vis.show();
            vis.setResizable(false);

        } catch (IOException e) {
            e.printStackTrace();
        }
    }


    public void gestione() throws IOException {
        try {
            FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("Gestione.fxml"));
            Scene scene = new Scene(fxmlLoader.load(), 800, 600);

            Stage ges = new Stage();
            ges.setTitle("Gestione Pazienti");
            ges.setScene(scene);
            ges.show();
            ges.setResizable(false);

        } catch (IOException e) {
            e.printStackTrace();
        }
    }

}
