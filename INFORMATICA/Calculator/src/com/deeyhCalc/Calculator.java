package com.deeyhCalc;

import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.JButton;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;
import java.awt.Font;
import java.awt.Color;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;
import javax.swing.JLabel;
import javax.swing.JEditorPane;
import javax.swing.SwingConstants;
import javax.swing.UIManager;
import javax.swing.JTextPane;
import java.beans.PropertyChangeListener;
import java.beans.PropertyChangeEvent;
import javax.swing.DropMode;
import javax.swing.JTextArea;
import com.jgoodies.forms.factories.DefaultComponentFactory;
import javax.swing.JTextField;

public class Calculator {

	private JFrame frame;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					Calculator window = new Calculator();
					window.frame.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the application.
	 */
	public Calculator() {
		initialize();
	}
	public float num1 = 0;
	public float num2 = 0;
	public float result = 0;
	public String operations;
	private JTextField textField;
	/**
	 * Initialize the contents of the frame.
	 */
	private void initialize() {
		
		
		frame = new JFrame();
		frame.setBounds(100, 100, 350, 510);
		frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		frame.getContentPane().setLayout(null);
		frame.setResizable(false);
		
		textField = new JTextField();
		textField.setBackground(new Color(255, 255, 255));
		textField.setFont(new Font("Times New Roman", Font.PLAIN, 80));
		textField.setHorizontalAlignment(SwingConstants.RIGHT);
		textField.setEditable(false);
		textField.setBounds(10, 77, 314, 101);
		frame.getContentPane().add(textField);
		textField.setColumns(10);
		
		final JButton btnNewButton_9 = new JButton("0");
		btnNewButton_9.addMouseListener(new MouseAdapter() {
			@Override
			public void mouseClicked(MouseEvent e) {
				String Enternumber = textField.getText() + btnNewButton_9.getText();
				textField.setText(Enternumber);
				
			}
		});
		btnNewButton_9.setBackground(new Color(192, 192, 192));
		btnNewButton_9.setFont(new Font("Tahoma", Font.PLAIN, 30));
		btnNewButton_9.setBounds(10, 405, 119, 55);
		frame.getContentPane().add(btnNewButton_9);
		
		JButton btnNewButton_9_1 = new JButton("=");
		btnNewButton_9_1.addMouseListener(new MouseAdapter() {
			@Override
			public void mouseClicked(MouseEvent e) {
				String answer;
				num2 = Float.parseFloat(textField.getText());
				if(operations == "+")
				{
					result = num1 + num2;
					answer = String.format("%.2f", result);
					textField.setText(answer);
				}
				else if(operations == "-")
				{
					result = num1 - num2;
					answer = String.format("%.2f", result);
					textField.setText(answer);
				}
				else if(operations == "*")
				{
					result = num1 * num2;
					answer = String.format("%.2f", result);
					textField.setText(answer);
				}
				else if(operations == "/")
				{
					result = num1 / num2;
					answer = String.format("%.2f", result);
					textField.setText(answer);
				}
				else if(operations == "%")
				{
					result = num1 % num2;
					answer = String.format("%.2f", result);
					textField.setText(answer);
				}
				else if (operations == "√") {
				    result = (float) Math.sqrt(num1);
				    num2 = 0;
				    answer = String.format("%.2f", result);
				    textField.setText(answer);
				}
				
			}
		});
		btnNewButton_9_1.setBackground(new Color(225, 225, 225));
		btnNewButton_9_1.setFont(new Font("Tahoma", Font.PLAIN, 25));
		btnNewButton_9_1.setBounds(269, 339, 55, 121);
		frame.getContentPane().add(btnNewButton_9_1);
		
		final JButton btnNewButton_9_1_1 = new JButton(".");
		btnNewButton_9_1_1.setBackground(new Color(225, 225, 225));
		btnNewButton_9_1_1.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				String Enternumber = textField.getText() + btnNewButton_9_1_1.getText();
				textField.setText(Enternumber);	
			}
		});
		btnNewButton_9_1_1.setFont(new Font("Tahoma", Font.PLAIN, 30));
		btnNewButton_9_1_1.setBounds(139, 405, 55, 55);
		frame.getContentPane().add(btnNewButton_9_1_1);
		
		JButton btnNewButton_9_1_2 = new JButton("+");
		btnNewButton_9_1_2.addMouseListener(new MouseAdapter() {
			@Override
			public void mouseClicked(MouseEvent e) {
				num1 = Float.parseFloat(textField.getText());
				textField.setText("");
				operations = "+";
				
			}
		});
		btnNewButton_9_1_2.setBackground(new Color(225, 225, 225));
		btnNewButton_9_1_2.setFont(new Font("Tahoma", Font.PLAIN, 25));
		btnNewButton_9_1_2.setBounds(204, 405, 55, 55);
		frame.getContentPane().add(btnNewButton_9_1_2);
		
		JButton btnNewButton_9_1_1_2 = new JButton("-");
		btnNewButton_9_1_1_2.addMouseListener(new MouseAdapter() {
			@Override
			public void mouseClicked(MouseEvent e) {
				num1 = Float.parseFloat(textField.getText());
				textField.setText("");
				operations = "-";
			}
		});
		btnNewButton_9_1_1_2.setBackground(new Color(225, 225, 225));
		btnNewButton_9_1_1_2.setFont(new Font("MS UI Gothic", Font.BOLD, 30));
		btnNewButton_9_1_1_2.setBounds(204, 339, 55, 55);
		frame.getContentPane().add(btnNewButton_9_1_1_2);
		
		JButton btnNewButton_9_1_1_2_1 = new JButton("x");
		btnNewButton_9_1_1_2_1.setBackground(new Color(225, 225, 225));
		btnNewButton_9_1_1_2_1.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				num1 = Float.parseFloat(textField.getText());
				textField.setText("");
				operations = "*";
			}
		});
		btnNewButton_9_1_1_2_1.setFont(new Font("Tahoma", Font.PLAIN, 30));
		btnNewButton_9_1_1_2_1.setBounds(204, 273, 55, 55);
		frame.getContentPane().add(btnNewButton_9_1_1_2_1);
		
		JButton btnNewButton_9_1_1_2_2 = new JButton("/");
		btnNewButton_9_1_1_2_2.addMouseListener(new MouseAdapter() {
			@Override
			public void mouseClicked(MouseEvent e) {
				num1 = Float.parseFloat(textField.getText());
				textField.setText("");
				operations = "/";
			}
		});
		btnNewButton_9_1_1_2_2.setBackground(new Color(225, 225, 225));
		btnNewButton_9_1_1_2_2.setFont(new Font("Tahoma", Font.PLAIN, 30));
		btnNewButton_9_1_1_2_2.setBounds(204, 207, 55, 55);
		frame.getContentPane().add(btnNewButton_9_1_1_2_2);
		
		JButton btnNewButton_9_1_1_2_3 = new JButton("%");
		btnNewButton_9_1_1_2_3.addMouseListener(new MouseAdapter() {
			@Override
			public void mouseClicked(MouseEvent e) {
				num1 = Float.parseFloat(textField.getText());
				textField.setText("");
				operations = "%";
				
			}
		});
		btnNewButton_9_1_1_2_3.setBackground(new Color(225, 225, 225));
		btnNewButton_9_1_1_2_3.setFont(new Font("Nyala", Font.PLAIN, 20));
		btnNewButton_9_1_1_2_3.setBounds(269, 273, 55, 55);
		frame.getContentPane().add(btnNewButton_9_1_1_2_3);
		
		final JButton btnNewButton_9_1_1_1 = new JButton("1");
		btnNewButton_9_1_1_1.addMouseListener(new MouseAdapter() {
			@Override
			public void mouseClicked(MouseEvent e) {
				String Enternumber = textField.getText() + btnNewButton_9_1_1_1.getText();
				textField.setText(Enternumber);
			}
		});
		btnNewButton_9_1_1_1.setBackground(new Color(192, 192, 192));
		btnNewButton_9_1_1_1.setFont(new Font("Tahoma", Font.PLAIN, 30));
		btnNewButton_9_1_1_1.setBounds(10, 339, 55, 55);
		frame.getContentPane().add(btnNewButton_9_1_1_1);
		
		final JButton btnNewButton_9_1_1_3 = new JButton("2");
		btnNewButton_9_1_1_3.addMouseListener(new MouseAdapter() {
			@Override
			public void mouseClicked(MouseEvent e) {
				String Enternumber = textField.getText() + btnNewButton_9_1_1_3.getText();
				textField.setText(Enternumber);
			}
		});
		btnNewButton_9_1_1_3.setBackground(new Color(192, 192, 192));
		btnNewButton_9_1_1_3.setFont(new Font("Tahoma", Font.PLAIN, 30));
		btnNewButton_9_1_1_3.setBounds(74, 339, 55, 55);
		frame.getContentPane().add(btnNewButton_9_1_1_3);
		
		
		
		final JButton btnNewButton_9_1_1_4 = new JButton("3");
		btnNewButton_9_1_1_4.addMouseListener(new MouseAdapter() {
			@Override
			public void mouseClicked(MouseEvent e) {
				String Enternumber = textField.getText() + btnNewButton_9_1_1_4.getText();
				textField.setText(Enternumber);
			}
		});
		btnNewButton_9_1_1_4.setBackground(new Color(192, 192, 192));
		btnNewButton_9_1_1_4.setFont(new Font("Tahoma", Font.PLAIN, 30));
		btnNewButton_9_1_1_4.setBounds(139, 339, 55, 55);
		frame.getContentPane().add(btnNewButton_9_1_1_4);
		
		final JButton btnNewButton_9_1_1_5 = new JButton("6");
		btnNewButton_9_1_1_5.addMouseListener(new MouseAdapter() {
			@Override
			public void mouseClicked(MouseEvent e) {
				String Enternumber = textField.getText() + btnNewButton_9_1_1_5.getText();
				textField.setText(Enternumber);
			}
		});
		btnNewButton_9_1_1_5.setBackground(new Color(192, 192, 192));
		btnNewButton_9_1_1_5.setFont(new Font("Tahoma", Font.PLAIN, 30));
		btnNewButton_9_1_1_5.setBounds(139, 273, 55, 55);
		frame.getContentPane().add(btnNewButton_9_1_1_5);
		
		final JButton btnNewButton_9_1_1_6 = new JButton("5");
		btnNewButton_9_1_1_6.addMouseListener(new MouseAdapter() {
			@Override
			public void mouseClicked(MouseEvent e) {
				String Enternumber = textField.getText() + btnNewButton_9_1_1_6.getText();
				textField.setText(Enternumber);
			}
		});
		btnNewButton_9_1_1_6.setBackground(new Color(192, 192, 192));
		btnNewButton_9_1_1_6.setFont(new Font("Tahoma", Font.PLAIN, 30));
		btnNewButton_9_1_1_6.setBounds(74, 273, 55, 55);
		frame.getContentPane().add(btnNewButton_9_1_1_6);
		
		final JButton btnNewButton_9_1_1_7 = new JButton("4");
		btnNewButton_9_1_1_7.addMouseListener(new MouseAdapter() {
			@Override
			public void mouseClicked(MouseEvent e) {
				String Enternumber = textField.getText() + btnNewButton_9_1_1_7.getText();
				textField.setText(Enternumber);
			}
		});
		btnNewButton_9_1_1_7.setBackground(new Color(192, 192, 192));
		btnNewButton_9_1_1_7.setFont(new Font("Tahoma", Font.PLAIN, 30));
		btnNewButton_9_1_1_7.setBounds(10, 273, 55, 55);
		frame.getContentPane().add(btnNewButton_9_1_1_7);
		
		JButton btnNewButton_9_1_1_10 = new JButton("C");
		btnNewButton_9_1_1_10.addMouseListener(new MouseAdapter() {
			@Override
			public void mouseClicked(MouseEvent e) {
				textField.setText("");
			}
		});
		btnNewButton_9_1_1_10.setBackground(new Color(255, 83, 83));
		btnNewButton_9_1_1_10.setFont(new Font("Tahoma", Font.BOLD, 23));
		btnNewButton_9_1_1_10.setBounds(269, 207, 55, 55);
		frame.getContentPane().add(btnNewButton_9_1_1_10);
		
		final JButton btnNewButton_9_1_1_5_1 = new JButton("9");
		btnNewButton_9_1_1_5_1.addMouseListener(new MouseAdapter() {
			@Override
			public void mouseClicked(MouseEvent e) {
				String Enternumber = textField.getText() + btnNewButton_9_1_1_5_1.getText();
				textField.setText(Enternumber);
			}
		});
		btnNewButton_9_1_1_5_1.setBackground(new Color(192, 192, 192));
		btnNewButton_9_1_1_5_1.setFont(new Font("Tahoma", Font.PLAIN, 30));
		btnNewButton_9_1_1_5_1.setBounds(139, 207, 55, 55);
		frame.getContentPane().add(btnNewButton_9_1_1_5_1);
		
		final JButton btnNewButton_9_1_1_5_2 = new JButton("8");
		btnNewButton_9_1_1_5_2.addMouseListener(new MouseAdapter() {
			@Override
			public void mouseClicked(MouseEvent e) {
				String Enternumber = textField.getText() + btnNewButton_9_1_1_5_2.getText();
				textField.setText(Enternumber);
			}
		});
		btnNewButton_9_1_1_5_2.setBackground(new Color(192, 192, 192));
		btnNewButton_9_1_1_5_2.setFont(new Font("Tahoma", Font.PLAIN, 30));
		btnNewButton_9_1_1_5_2.setBounds(74, 207, 55, 55);
		frame.getContentPane().add(btnNewButton_9_1_1_5_2);
		
		final JButton btnNewButton_9_1_1_5_3 = new JButton("7");
		btnNewButton_9_1_1_5_3.addMouseListener(new MouseAdapter() {
			@Override
			public void mouseClicked(MouseEvent e) {
				String Enternumber = textField.getText() + btnNewButton_9_1_1_5_3.getText();
				textField.setText(Enternumber);
			}
		});
		btnNewButton_9_1_1_5_3.setBackground(new Color(192, 192, 192));
		btnNewButton_9_1_1_5_3.setFont(new Font("Tahoma", Font.PLAIN, 30));
		btnNewButton_9_1_1_5_3.setBounds(10, 207, 55, 55);
		frame.getContentPane().add(btnNewButton_9_1_1_5_3);
		
		
		JLabel lblNewLabel_1 = new JLabel("CALCULATOR 2000");
		lblNewLabel_1.setBackground(new Color(255, 83, 83));
		lblNewLabel_1.setFont(new Font("Serif", Font.PLAIN, 35));
		lblNewLabel_1.setBounds(10, 11, 314, 49);
		frame.getContentPane().add(lblNewLabel_1);
		
		
		
		
		
		
		
	}
}
