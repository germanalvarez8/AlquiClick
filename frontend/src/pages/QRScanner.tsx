import { useState, useEffect, useRef } from 'react';
import { useNavigate } from 'react-router-dom';
import {
  Container,
  Box,
  Typography,
  Paper,
  CircularProgress,
} from '@mui/material';
import { BrowserQRCodeReader, IScannerControls } from '@zxing/browser';
import { Result } from '@zxing/library';

const QRScanner = () => {
  const navigate = useNavigate();
  const [loading, setLoading] = useState(false);
  const videoRef = useRef<HTMLVideoElement>(null);
  const controlsRef = useRef<IScannerControls | null>(null);

  useEffect(() => {
    const startScanner = async () => {
      if (!videoRef.current) return;

      try {
        const codeReader = new BrowserQRCodeReader();
        controlsRef.current = await codeReader.decodeFromVideoDevice(
          undefined,
          videoRef.current,
          (result: Result | null, error: Error | null) => {
            if (result) {
              try {
                const buildingId = result.getText().split('/').pop();
                if (buildingId) {
                  setLoading(true);
                  navigate(`/buildings/${buildingId}`);
                }
              } catch (error) {
                console.error('Error scanning QR:', error);
              }
            }
            if (error) {
              console.error('QR Scanner error:', error);
            }
          }
        );
      } catch (error) {
        console.error('Error starting scanner:', error);
      }
    };

    startScanner();

    return () => {
      if (controlsRef.current) {
        controlsRef.current.stop();
      }
    };
  }, [navigate]);

  return (
    <Container maxWidth="sm">
      <Box sx={{ mt: 4 }}>
        <Typography variant="h4" component="h1" gutterBottom align="center">
          Scan Building QR Code
        </Typography>
        <Paper
          elevation={3}
          sx={{
            p: 2,
            display: 'flex',
            flexDirection: 'column',
            alignItems: 'center',
          }}
        >
          {loading ? (
            <CircularProgress />
          ) : (
            <video
              ref={videoRef}
              style={{ width: '100%', maxWidth: '500px' }}
            />
          )}
        </Paper>
        <Typography variant="body2" color="text.secondary" align="center" sx={{ mt: 2 }}>
          Point your camera at a building's QR code to view available rooms
        </Typography>
      </Box>
    </Container>
  );
};

export default QRScanner; 