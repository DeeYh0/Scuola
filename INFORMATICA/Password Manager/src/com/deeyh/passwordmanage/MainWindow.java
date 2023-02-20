package com.deeyh.passwordmanage;

import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import java.awt.event.ActionListener;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;
import java.awt.event.ActionEvent;
import java.awt.Font;
import java.awt.Image;

import javax.swing.JTextField;
import javax.swing.JLabel;
import javax.swing.JEditorPane;
import javax.swing.SwingConstants;

public class MainWindow {

	private JFrame frame;

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
		frame.setBounds(100, 100, 623, 441);
		frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		frame.getContentPane().setLayout(null);
		
		JButton btnNewButton = new JButton("AGGIUNGI PASSWORD");
		btnNewButton.setFont(new Font("Microsoft YaHei", Font.PLAIN, 20));
		btnNewButton.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				AddPass ap = new AddPass();
				ap.frame.setVisible(true);
				frame.setVisible(false);
			}
		});
		btnNewButton.setBounds(147, 193, 320, 54);
		frame.getContentPane().add(btnNewButton);
		
		JButton btnVisualizzaPassword = new JButton("VISUALIZZA PASSWORD");
		btnVisualizzaPassword.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				ViewPass vp = new ViewPass();
				vp.frame.setVisible(true);
				frame.setVisible(false);
			}
		});
		btnVisualizzaPassword.setFont(new Font("Microsoft YaHei", Font.PLAIN, 20));
		btnVisualizzaPassword.setBounds(147, 257, 320, 54);
		frame.getContentPane().add(btnVisualizzaPassword);
		
		JButton btnExit = new JButton("EXIT");
		btnExit.setFont(new Font("Microsoft YaHei", Font.PLAIN, 20));
		btnExit.setBounds(497, 357, 102, 37);
		frame.getContentPane().add(btnExit);
		btnExit.addMouseListener(new MouseAdapter() {
			public void mouseClicked(MouseEvent e) {
				System.exit(0);
			}
		});
		
		JLabel lblNewLabel = new JLabel("CIAO VITO!");
		lblNewLabel.setFont(new Font("Century", Font.PLAIN, 40));
		lblNewLabel.setBounds(184, 0, 254, 80);
		frame.getContentPane().add(lblNewLabel);
		
		JLabel lblNewLabel_1 = new JLabel("");
		lblNewLabel_1.setHorizontalAlignment(SwingConstants.CENTER);
		Image img = new ImageIcon(this.getClass().getResource("/password.png")).getImage();
		lblNewLabel_1.setIcon(new ImageIcon(img));
		lblNewLabel_1.setBounds(134, 67, 350, 116);
		frame.getContentPane().add(lblNewLabel_1);
	}
}
