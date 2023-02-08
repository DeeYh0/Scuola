package com.deeyhMC;

import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.SwingConstants;

import java.awt.Font;
import java.awt.Image;
import java.awt.Color;

import javax.swing.ImageIcon;
import javax.swing.JButton;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;

public class MainWindow {

	public JFrame frame;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					MainWindow window = new MainWindow();
					window.frame.setVisible(true);
					window.frame.setResizable(false);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the application.
	 */
	public MainWindow() {
		initialize();
	}

	/**
	 * Initialize the contents of the frame.
	 */
	private void initialize() {
		frame = new JFrame();
		frame.setBounds(104, 100, 684, 522);
		frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		frame.getContentPane().setLayout(null);
		
		JButton btnNewButton = new JButton("MENU CLIENTE");
		btnNewButton.setFont(new Font("Tahoma", Font.PLAIN, 30));
		btnNewButton.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				menu M = new menu();
				M.frame.setVisible(true);
				M.frame.setResizable(false);
				frame.setVisible(false);
				
			}
		});
		btnNewButton.setBounds(124, 168, 420, 76);
		frame.getContentPane().add(btnNewButton);
		
		JButton btnAcquistaProdotto = new JButton("ACQUISTA PRODOTTO");
		btnAcquistaProdotto.addMouseListener(new MouseAdapter() {
			@Override
			public void mouseClicked(MouseEvent e) {
				Acquista aq = new Acquista();
				aq.frame.setVisible(true);
				aq.frame.setResizable(false);
				frame.setVisible(false);
			}
		});
		btnAcquistaProdotto.setFont(new Font("Tahoma", Font.PLAIN, 30));
		btnAcquistaProdotto.setBounds(124, 256, 420, 76);
		frame.getContentPane().add(btnAcquistaProdotto);
		
		JButton btnVisualizzaScontrino = new JButton("VISUALIZZA SCONTRINO");
		btnVisualizzaScontrino.setFont(new Font("Tahoma", Font.PLAIN, 30));
		btnVisualizzaScontrino.setBounds(124, 342, 420, 76);
		frame.getContentPane().add(btnVisualizzaScontrino);
		
		JButton btnExit = new JButton("EXIT");
		btnExit.addMouseListener(new MouseAdapter() {
			@Override
			public void mouseClicked(MouseEvent e) {
				System.exit(0);
			}
		});
		btnExit.setFont(new Font("Tahoma", Font.PLAIN, 16));
		btnExit.setBounds(569, 438, 91, 37);
		frame.getContentPane().add(btnExit);
		
		JLabel lblNewLabel_1 = new JLabel("");
		lblNewLabel_1.setHorizontalAlignment(SwingConstants.CENTER);
		Image img = new ImageIcon(this.getClass().getResource("/McDonalds.png")).getImage();
		lblNewLabel_1.setIcon(new ImageIcon(img));
		lblNewLabel_1.setBounds(10, 10, 650, 154);
		frame.getContentPane().add(lblNewLabel_1);
		
		JLabel lblNewLabel = new JLabel("\r\n");
		lblNewLabel.setHorizontalAlignment(SwingConstants.CENTER);
		Image img1 = new ImageIcon(this.getClass().getResource("/logo.jpg")).getImage();
		lblNewLabel.setIcon(new ImageIcon(img1));
		lblNewLabel.setBounds(10, 375, 100, 100);
		frame.getContentPane().add(lblNewLabel);
		
	}
}
