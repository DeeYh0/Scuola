package com.deeyh.studiodentistico;

import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.stage.FileChooser;
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
        ab.show(false);
    }
}
